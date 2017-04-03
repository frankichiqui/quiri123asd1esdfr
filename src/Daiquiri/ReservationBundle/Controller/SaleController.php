<?php

namespace Daiquiri\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Sale controller.
 *
 */
class SaleController extends \Sonata\AdminBundle\Controller\CRUDController {

    public function shoppingCartDetailAction() {

        $em = $this->getDoctrine()->getManager();
        $cart = $this->get('reservation.cartitem')->getArrayCartAction($this->getRequest(), $em);
        $sale = new \Daiquiri\ReservationBundle\Entity\Sale();
        $sale->setClient($this->getUser());
        foreach ($cart as $item) {
            $s = new \Daiquiri\ReservationBundle\Entity\Service();
            $paxs = $item->getArrayPaxs();
            for ($i = 0; $i < count($paxs); $i++) {
                $s->addServicepax(new \Daiquiri\ReservationBundle\Entity\ServicePax());
            }
            $sale->addService($s);
        }
        $form = $this->admin->getForm();
        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:Default:shopping_cart_detail.html.twig');

        return $this->render($view_render, array(
                    'form' => $form->setData($sale)->createView(),
                    'cart' => $cart,
                    'action' => 'create',
                    'sale' => $sale,
        ));
    }

    public function createAction() {

        $request = $this->getRequest();
        
        //dump($request);die;
        // the key used to lookup the template
        $templateKey = 'edit';
        //$this->admin->checkAccess('create');
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

        $em = $this->getDoctrine()->getManager();
        $cart = $this->get('reservation.cartitem')->getArrayCartAction($this->getRequest(), $em);
        $sale = new \Daiquiri\ReservationBundle\Entity\Sale();
        $sale->setClient($this->getUser());

        //dump($cart[0]->getArrayPaxs());die;

        foreach ($cart as $item) {
            $s = new \Daiquiri\ReservationBundle\Entity\Service();
            $s->setCartitem($item);

            $paxs = $item->getArrayPaxs();
            for ($i = 0; $i < count($paxs); $i++) {
                $s->addServicepax(new \Daiquiri\ReservationBundle\Entity\ServicePax());
            }
            $sale->addService($s);
        }



        $object = $sale;

       //dump($object);die;

        $preResponse = $this->preCreate($request, $object);
        if ($preResponse !== null) {

            return $preResponse;
        }
        
        $admin = $this->get('admin.sale');
        //dump($admin);die;
       


        $this->admin->setSubject($object);
        
        

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        
        //dump($object);die;

        $form->setData($object);

        /* dump($form->getData());
          die; */

        $form->handleRequest($request);

        dump($form->getData());die;

        if ($form->isSubmitted()) {   
            
            //echo "1234";die;
           
            //TODO: remove this check for 4.0
            if (method_exists($this->admin, 'preValidate')) {
                $this->admin->preValidate($object);
            }
            $isFormValid = $form->isValid();



            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode($request) || $this->isPreviewApproved($request))) {
                //$this->admin->checkAccess('create', $object);

                try {

                    $object->setDate(new \DateTime('now'));
                    $object->setPdfview(0);
                    $object->setCreatedFromIp($this->getRequest()->getClientIp());
                    $a = $this->getRequest()->getSession()->get('currency', 'usd');
                    $em = $this->getDoctrine()->getManager();
                    $currency = $em->getRepository("DaiquiriAdminBundle:Currency")->findOneBy(array('nomenclator' => $a));
                    $object->setCurrency($currency);

                    $market_title = $this->getRequest()->getSession()->get('market', array('title' => 'DEFAULT'));
                    $market = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:market')->findOneBy(array('title' => $market_title));
                    $object->setMarket($market);

                    foreach ($object->getServices() as $s) {
                        $s->setServicemanagementstatus($this->getNewManagementStatus());
                        $s->setStatusByUser($this->getSystemUserForManagementStatus());
                    }

                    $object = $this->admin->create($object);
                    if ($this->isXmlHttpRequest()) {
                        $conte = $this->forward('DaiquiriReservationBundle:ConfigurationPam:getFormViewToSendPam', array(
                            '_sonata_admin' => 'admin.configurationpam',
                            'id' => $this->admin->getNormalizedIdentifier($object),
                            'bundle' => $this->getRequest()->get('bundle', 'Reservation'),
                            'folder' => $this->getRequest()->get('folder', 'Sale'),
                            'view_ok' => $this->getRequest()->get('bundle', 'payment_ok'),
                            'view_fail' => $this->getRequest()->get('bundle', 'payment_fail'),
                        ));
                        //dump($conte->getContent());die;
                        return $this->renderJson(array(
                                    'conte' => $conte->getContent(),
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
        
       // echo "fail666";die;

        /*if ($request->get('front') == 1) {
            try {

                echo "fail";
                die;
                $object->setDate(new \DateTime('now'));
                $object->setPdfview(0);
                $object->setCreatedFromIp($this->getRequest()->getClientIp());
                $a = $this->getRequest()->getSession()->get('currency', 'usd');
                $em = $this->getDoctrine()->getManager();
                $currency = $em->getRepository("DaiquiriAdminBundle:Currency")->findOneBy(array('nomenclator' => $a));
                $object->setCurrency($currency);

                $market_title = $this->getRequest()->getSession()->get('market', array('title' => 'DEFAULT'));
                $market = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:market')->findOneBy(array('title' => $market_title));
                $object->setMarket($market);

                foreach ($object->getServices() as $s) {
                    $s->setServicemanagementstatus($this->getNewManagementStatus());
                    $s->setStatusByUser($this->getSystemUserForManagementStatus());
                }

                $object = $this->admin->create($object);
                if ($this->isXmlHttpRequest()) {
                    $conte = $this->forward('DaiquiriReservationBundle:ConfigurationPam:getFormViewToSendPam', array(
                        '_sonata_admin' => 'admin.configurationpam',
                        'id' => $this->admin->getNormalizedIdentifier($object),
                        'bundle' => $this->getRequest()->get('bundle', 'Reservation'),
                        'folder' => $this->getRequest()->get('folder', 'Sale'),
                        'view_ok' => $this->getRequest()->get('bundle', 'payment_ok'),
                        'view_fail' => $this->getRequest()->get('bundle', 'payment_fail'),
                    ));
                    //dump($conte->getContent());die;
                    return $this->renderJson(array(
                                'conte' => $conte->getContent(),
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
                dump($e);
                die;
                $this->handleModelManagerException($e);

                $isFormValid = false;
            }
        }*/

        $view = $form->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->render($this->admin->getTemplate($templateKey), array(
                    'action' => 'create',
                    'form' => $view,
                    'object' => $object,
                        ), null);
    }

    function showAllServicesDetailAction($id, $view_sale = 'DaiquiriReservationBundle:Sale:show_all_services_detail.html.twig', $view_service = 'DaiquiriReservationBundle:Service:show_detail.html.twig') {
        $sale = $this->getDoctrine()->getManager()->getRepository('DaiquiriReservationBundle:Sale')->find($id);
        if ($this->isXmlHttpRequest()) {
            if ($sale) {
                $conte = $this->renderView($view_sale, array(
                    'sale' => $sale,
                    'view_service' => $view_service));

                return new Response(json_encode(array(
                            'success' => true,
                            'title' => 'ORDER ID: ' . $sale->getOrderId(),
                            'content' => $conte
                )));
            } else {

                return new Response(json_encode(array(
                            'success' => true,
                            'title' => 'ERROR',
                            'content' => "Not found ID: " . $id
                )));
            }
        }
        return $this->render($view_sale, array(
                    'sale' => $sale,
                    'view_service' => $view_service));
    }

    public function getNewManagementStatus() {
        $status = $this->getDoctrine()->getManager()->getRepository('DaiquiriReservationBundle:ServiceManagementStatus')->findOneBy(array('status' => 'NEW'));
        if (!$status) {
            $status = new \Daiquiri\ReservationBundle\Entity\ServiceManagementStatus();
            $status->setStatus('NEW');
            $status->setColor('#6495ED');
            $this->getDoctrine()->getManager()->persist($status);
            $this->getDoctrine()->getManager()->flush();
        }
        return $status;
    }

    public function getSystemUserForManagementStatus() {
        //dump($this->getDoctrine()->getManager());die;
        $user = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:DUser')->findOneBy(array('username' => 'system'));
        if (!$user) {
            $user = new \Daiquiri\AdminBundle\Entity\DUser();
            $user->setUsername('system');
            $user->setEmail('no-reply@daiquiricuba.com');
            $user->setPlainPassword("system-no-reply2015");
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
        }
        return $user;
    }

    public function genereVoucherBySaleAction($id) {
        $em = $this->getDoctrine()->getManager();

        $sale = $em->getRepository('DaiquiriReservationBundle:Sale')->find($id);
        if (!$sale) {
            $this->addFlash('error', "Sale whith ID " . $id . " Not found");
            return $this->redirect($this->admin->generateObjectUrl('list', $sale));
        }

        if ($sale->getPdfView() >= 5) {
            $this->addFlash('error', "Maximun view for " . $sale->getOrderId() . " Sale");
            return $this->redirect($this->admin->generateObjectUrl('list', $sale));
        } else {
            $sale->incrementPdfView();
            $em->persist($sale);
            $em->flush();
        }
        $pdf = new \Daiquiri\AdminBundle\Entity\VoucherPDF('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('DAIQUIRI TOURS CUBA S.A.');
        $pdf->SetTitle('DAIQUIRI TOURS CUBA. VOUCHER ' . $sale->getOrderId());
        $pdf->SetSubject('Vaucher for Sale ' . $sale->getOrderId());
        $pdf->setFontSubsetting(true);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetFont('helvetica', '', 10, '', true);
        $pdf->SetMargins(5, 5, 5, true);
        $filename = $sale->getOrderId() . strtoupper($sale->getClient()->getUsername());
        $content = "";
        foreach ($sale->getServices() as $s) {
            $pdf->AddPage();
            $html = $this->render('DaiquiriReservationBundle:' . $s->getCartitem()->getRootFolder() . ':pdf_voucher.html.twig', array('service' => $s));
            $content = $html->getContent();
            $pdf->writeHTML($content, $ln = true, $fill = false, $reseth = false, $cell = false, $align = 'C');
        }
        //codigo de la vista       
        return new StreamedResponse(
                function () use ($pdf, $filename) {
            $pdf->Output($filename . '.pdf');
        });
    }

    public function getViewAllSalesAction() {
        return $this->render('DaiquiriReservationBundle:Sale:all-sales.html.twig');
    }

}
