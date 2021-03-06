<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Form\FormMapper;
use Daiquiri\AdminBundle\Entity\TransferColective;
use Daiquiri\AdminBundle\Form\TransferColectiveType;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;


/**
 * TransferColective controller.
 *
 */
class TransferColectiveController extends SonataCRUDController {

    public function createAction() {
        $request = $this->getRequest();
        // the key used to lookup the template
        $templateKey = 'edit';
        $this->admin->checkAccess('create');
        $class = new \ReflectionClass($this->admin->hasActiveSubClass() ? $this->admin->getActiveSubClass() : $this->admin->getClass());
        if ($class->isAbstract()) {
            return $this->render(
                            'SonataAdminBundle:CRUD:select_subclass.html.twig', array(
                        'base_template' => $this->getBaseTemplate(),
                        'admin' => $this->admin,
                        'action' => 'create',
                            ), null, $request
            );
        }

        $object = $this->admin->getNewInstance();


        $preResponse = $this->preCreate($request, $object);
        if ($preResponse !== null) {
            return $preResponse;
        }

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //TODO: remove this check for 4.0
            if (method_exists($this->admin, 'preValidate')) {
                $this->admin->preValidate($object);
            }
            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode($request) || $this->isPreviewApproved($request))) {
                $this->admin->checkAccess('create', $object);

                try {
                    $object->setTitle($object->getPlacefrom()->getTitle() . ' - ' . $object->getPlaceto()->getTitle());
                    $object = $this->admin->create($object);

                    if ($object->getReverse()) {
                        $reverse = clone $object;
                        $aux_place = $reverse->getPlacefrom();
                        $reverse->setPlacefrom($reverse->getPlaceto());
                        $reverse->setPlaceto($aux_place);
                        $reverse->setTitle($object->getPlaceto()->getTitle() . " - " . $object->getPlacefrom()->getTitle());
                        $reverse = $this->admin->create($reverse);
                    }


                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                                    'result' => 'ok',
                                    'objectId' => $this->admin->getNormalizedIdentifier($object),
                                        ), 200, array());
                    }

                    $this->addFlash(
                            'sonata_flash_success', $this->admin->trans(
                                    'flash_create_success', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );

                    // redirect to edit mode
                    return $this->redirectTo($object);
                } catch (ModelManagerException $e) {
                    $this->handleModelManagerException($e);

                    $isFormValid = false;
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash(
                            'sonata_flash_error', $this->admin->trans(
                                    'flash_create_error', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );
                }
            } elseif ($this->isPreviewRequested()) {
                // pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                        ), null);
    }

    private function getReverseTransfer(TransferColective $transfer) {
        if (!$transfer->getReverse()) {
            return null;
        }
        $em = $this->getDoctrine()->getManager();
        $reverse = $em->getRepository('DaiquiriAdminBundle:TransferColective')->findOneBy(array(
            'placefrom' => $transfer->getPlaceto(),
            'placeto' => $transfer->getPlacefrom()
        ));

        return $reverse;
    }

    public function formTransferColectiveSearcherAction($id) {
        return $this->forward('DaiquiriReservationBundle:TransferSearcher:getFormIntoTransferSearcher', array(
                    'id' => $id,
                    '_sonata_admin' => 'admin.transfer.searcher',
                    'view_render' => 'DaiquiriReservationBundle:Transfer:form_searcher_into_transfer.html.twig',
        ));
    }

    public function formCreateTransferColectiveByPoloAndTypeAction() {
        $form = $this->formCreateTransferColectiveByPoloAndTypeAux();
        return $this->render('DaiquiriAdminBundle:TransferColective:form_create_transfer_colective_by_polo_and_type.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function addToCartAction(Request $request) {

        return $this->forward('DaiquiriReservationBundle:CartItem:addTransferColective', array('request' => $request));
    }

    public function CreateTransferColectiveByPoloAndTypeAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->formCreateTransferColectiveByPoloAndTypeAux();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            //dump($data);die;
            //obtengo todos los places origenes que sean pikuplace de tranfer y sean del polo deseado
            $placesfrom = $em->getRepository('DaiquiriAdminBundle:Place')->findBy(
                    array('ispickupplace_transfer' => true,
                        'polo' => $data['polofrom'],));
            //obtengo todos los places destino que sean pikuplace de tranfer y sean del polo deseado
            $placesto = $em->getRepository('DaiquiriAdminBundle:Place')->findBy(
                    array('ispickupplace_transfer' => true,
                        'polo' => $data['poloto'],));
            //vvalido que existan places de origin y destino para proceder la operacion
            if (!$placesfrom) {
                $this->addFlash('sonata_flash_info', 'Not Found Origin Place to Create Transfer ');
                return $this->render('DaiquiriAdminBundle:TransferColective:form_create_transfer_colective_by_polo_and_type.html.twig', array(
                            'form' => $form->createView()
                ));
            }
            if (!$placesto) {
                $this->addFlash('sonata_flash_info', 'Not Found Detination Place to Create Transfer ');
                return $this->render('DaiquiriAdminBundle:TransferColective:form_create_transfer_colective_by_polo_and_type.html.twig', array(
                            'form' => $form->createView()
                ));
            }
            //filtro de esos cuales tinen el typo de place entrado por parametro
            $origenes = array();
            $destination = array();
            foreach ($placesfrom as $place) {
                if ($place->hasPlaceType($data['placetypefrom'])) {
                    $origenes[] = $place;
                }
            }
            foreach ($placesto as $place) {
                if ($place->hasPlaceType($data['placetypeto'])) {
                    $destination[] = $place;
                }
            }
            $existent = array();
            $create_new = array();
            $update_price = array();
            foreach ($origenes as $origin) {
                foreach ($destination as $destino) {
                    if ($origin->getId() != $destino->getId()) {
                        //para cada origen y destino creo un transfer
                        $tranfers = new TransferColective();
                        $tranfers->setAvailable(false);
                        $tranfers->setPlacefrom($origin);
                        $tranfers->setPlaceto($destino);
                        $tranfers->setPrice($data['price']);
                        $tranfers->setAvailable(true);
                        $tranfers->setPayonline(true);
                        $tranfers->setReverse($data['reverse']);
                        $exist = $this->isExistTransfer($tranfers);
                        if (!$exist) {
                            //si esta marcado el reserve se crea el transfer de reversa y se agraga a los nuevos creados                           
                            $em->persist($tranfers);
                            $create_new[] = $tranfers;
                        } else {
                            // si existe algun transfer  y esta marcado el reverse                            
                            if ($exist->getPrice() != $data['price']) {
                                $exist->setPrice($data['price']);
                                $exist->setReverse($data['reverse']);
                                $em->persist($exist);
                                $update_price[] = $exist;
                            } else {
                                $existent[] = $exist;
                            }
                        }
                    }
                }
            }
            $em->flush();
            $this->addFlash('sonata_flash_success', 'Create ' . count($create_new) . ' item successfully.');
            return $this->render('DaiquiriAdminBundle:TransferColective:form_create_transfer_colective_by_polo_and_type.html.twig', array(
                        'new' => $create_new,
                        'exist' => $existent,
                        'update_price' => $update_price,
                        'form' => $form->createView()
            ));
        }
        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->render('DaiquiriAdminBundle:TransferColective:form_create_transfer_colective_by_polo_and_type.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function isExistTransfer(TransferColective $transfer) {

        $item = $this->thisRepository()->findOneBy(array('placefrom' => $transfer->getPlacefrom(), 'placeto' => $transfer->getPlaceto()));
        if ($item)
            return $item;
        return null;
    }

    private function thisRepository() {
        return $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:TransferColective');
    }

    private function formCreateTransferColectiveByPoloAndTypeAux() {
        $form = $this->createFormBuilder(
                        array(), array(), array())
                ->add('polofrom', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'label' => 'Origin',
                    'required' => true
                ))
                ->add('placetypefrom', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\PlaceType',
                    'property' => 'title',
                    'required' => true,
                    'label' => 'Origin Type Place (AirPort | Hotel)'
                ))
                ->add('poloto', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'required' => true,
                    'label' => 'Destination'
                ))
                ->add('placetypeto', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\PlaceType',
                    'property' => 'title',
                    'required' => true,
                    'label' => 'Destination Type Place (AirPort | Hotel)'
                ))
                ->add('reverse', 'checkbox', array(
                    'label' => 'Check this if you want generate reverse Transfer', 'required' => false))
                ->add('price', 'number', array('required' => true, 'attr' => array('class' => ' form-control')))
                ->getForm();
        return $form;
    }


    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DaiquiriAdminBundle:TransferColective')->find($id);

        $request = new \Daiquiri\ReservationBundle\Entity\TransferColectiveRequest();

        $request->setTransfer($entity);


        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveRequestType(), $request, array(
            'action' => $this->generateUrl('create-request-for-transfer-colective')
        ));

        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'object' => $entity
        ));
    }

}
