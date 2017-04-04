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
 * Car controller.
 *
 */
class PaymentController extends SonataCRUDController {

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
                    $em = $this->getDoctrine()->getManager();
                    $object->setClient($this->getUser());
                    $object->setDateCreated(new \DateTime('now'));
                    $object->setPdfview(0);
                    $a = $this->getRequest()->getSession()->get('currency', 'usd');
                    $currency = $em->getRepository("DaiquiriAdminBundle:Currency")->findOneBy(array('nomenclator' => $a));
                    $object->setCurrency($currency);
                    $object = $this->admin->create($object);
                    return $this->forward('DaiquiriReservationBundle:ConfigurationPam:getFormViewToSendPamPayment', array(
                                '_sonata_admin' => 'admin.configurationpam',
                                'id' => $object->getId(),
                                'bundle' => $this->getRequest()->get('bundle', 'Reservation'),
                                'folder' => $this->getRequest()->get('folder', 'Payment'),
                                'view_ok' => $this->getRequest()->get('bundle', 'payment_ok'),
                                'view_fail' => $this->getRequest()->get('bundle', 'payment_fail'),
                    ));



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

    public function createNewPaymentFormAction() {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->createAccessDeniedException();
        }
        $payment = new \Daiquiri\AdminBundle\Entity\Payment();
        $form = $this->createForm(new \Daiquiri\AdminBundle\Form\PaymentType(), $payment, array(
            'action' => $this->generateUrl('create-new-payment')
        ));
        return $this->render('DaiquiriAdminBundle:Payment:create.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function createNewPaymentAction() {
        $object = new \Daiquiri\AdminBundle\Entity\Payment();
        $request = $this->getRequest();
        $form = $this->createForm(new \Daiquiri\AdminBundle\Form\PaymentType(), $object, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $object->setClient($this->getUser());
            $object->setDateCreated(new \DateTime('now'));
            $object->setPdfview(0);
            $a = $this->getRequest()->getSession()->get('currency', 'usd');
            $currency = $em->getRepository("DaiquiriAdminBundle:Currency")->findOneBy(array('nomenclator' => $a));
            $object->setCurrency($currency);
            $em->persist($object);
            $em->flush();
            return $this->forward('DaiquiriReservationBundle:ConfigurationPam:getFormViewToSendPamPayment', array(
                        '_sonata_admin' => 'admin.configurationpam',
                        'id' => $object->getId(),
                        'bundle' => $this->getRequest()->get('bundle', 'Admin'),
                        'folder' => $this->getRequest()->get('folder', 'Payment'),
                        'view_ok' => $this->getRequest()->get('bundle', 'payment_ok'),
                        'view_fail' => $this->getRequest()->get('bundle', 'payment_fail'),
            ));
        }
    }

}
