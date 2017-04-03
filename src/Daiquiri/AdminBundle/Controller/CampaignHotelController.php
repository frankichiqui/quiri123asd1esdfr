<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;


/**
 * Airport controller.
 *
 */
class CampaignHotelController extends SonataCRUDController {

    public function editAction($id = null) {
        if ($this->getRequest()->get('allform', null)) {
            $this->admin->showkidelement = true;
        }
        return parent::editAction($id);
    }

    public function createAction() {
        if ($this->getRequest()->get('allform', null)) {
            $this->admin->showkidelement = true;
        }
        $em = $this->getDoctrine()->getManager();
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
                    $room = $object->getRoom();
                    $room->addCampaign($object);

                    $em->persist($room);
                    
                    $object = $this->admin->create($object);




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

    public function getAllHotelPrice(\Daiquiri\AdminBundle\Entity\CampaignHotel $campaign) {
        $em = $this->getDoctrine()->getManager();
        $salida = new \Doctrine\Common\Collections\ArrayCollection();
        $pricebyroom = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->findBy(array('room' => $campaign->getRoom()->getId()));
        $today = new \DateTime('today');
        foreach ($pricebyroom as $p) {
            if ($p->getSeason()->getStartdate() > $today) {
                $salida->add($p);
            }
        }
        return $salida;
    }

    public function formSetPriceAction($id, $hp_id = null) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('DaiquiriAdminBundle:CampaignHotel')->find($id);
        if ($hp_id) {
            $hotelprice = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->find($hp_id);
            if ($hotelprice && $object) {
                $object->setPriceDataPriceToHotelPrice($hotelprice);
                $this->admin->showkidelement = true;
                $form = $this->admin->getForm();
                $form->setData($object);
                return $this->render('DaiquiriAdminBundle:CampaignHotel:form_set_price.html.twig', array(
                            'form' => $form->createView(),
                            'season' => $this->getAllHotelPrice($object),
                            'object' => $object));
            }
        }


        if ($object) {
            if ($object->getKidpolicys()->count() > 0) {
                $this->admin->showkidelement = true;
                $form = $this->admin->getForm();
                $form->setData($object);
                return $this->render('DaiquiriAdminBundle:CampaignHotel:form_set_price.html.twig', array(
                            'form' => $form->createView(),
                            'season' => $this->getAllHotelPrice($object),
                            'object' => $object));
            } else {
                if ($object->getRoom()) {
                    $ocupations = $em->getRepository('DaiquiriAdminBundle:Ocupation')->findByRoom($object->getRoom()->getId());
                    $object->deleteAllkidPolityc();
                    foreach ($ocupations as $o) {
                        if ($o->hasOnlyKids() || !$o->hasOnlyAdults()) {
                            $k = new \Daiquiri\AdminBundle\Entity\KidPolicy();
                            $k->setOcupation($o);
                            $k->setCampaign($object);
                            $object->addKidpolicy($k);
                        }
                    }
                    $object->sortKidPolicysByAdultAndKid();
                    $this->admin->setSubject($object);
                    $this->admin->showkidelement = true;
                    $form = $this->admin->getForm();
                    $form->setData($object);
                    return $this->render('DaiquiriAdminBundle:CampaignHotel:form_set_price.html.twig', array(
                                'form' => $form->createView(),
                                'season' => $this->getAllHotelPrice($object),
                                'object' => $object));
                }
            }
        }
        return $this->render('DaiquiriAdminBundle:CampaignHotel:form_set_price.html.twig', array(
                    'form' => null,
                    'season' => null,
                    'object' => null));
    }

}
