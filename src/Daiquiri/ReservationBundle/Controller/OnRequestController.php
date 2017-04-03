<?php

namespace Daiquiri\ReservationBundle\Controller;

use Daiquiri\ReservationBundle\Entity\CartItem;
use Daiquiri\ReservationBundle\Entity\CarItem;
use Daiquiri\ReservationBundle\Entity\CircuitItem;
use Daiquiri\ReservationBundle\Entity\ColectiveTransferItem;
use Daiquiri\ReservationBundle\Entity\ExclusiveTransferItem;
use Daiquiri\ReservationBundle\Entity\OcupationItem;
use Daiquiri\ReservationBundle\Entity\PackageOption;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Daiquiri\ReservationBundle\Form\RentalHouseRequestType;
use Daiquiri\ReservationBundle\Entity\CarRequest;
use \Daiquiri\ReservationBundle\Entity\PackageRequest;
use \Daiquiri\ReservationBundle\Form\PackageRequestType;
use \Daiquiri\ReservationBundle\Form\CarRequestType;
use \Daiquiri\AdminBundle\Entity\Validate;

class OnRequestController extends Controller {

    public function RequestRentalHouseAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new RentalHouseRequest();
        $form = $this->createForm(new RentalHouseRequestType(), $object, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }


            if (!\Daiquiri\AdminBundle\Entity\Validate::startAndEndDate($object->getStartdate(), $object->getEnddate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Check in and Check out date invalid.')));
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {
                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        }

        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestCarAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new CarRequest();
        $form = $this->createForm(new CarRequestType(), $object, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }


            if (!\Daiquiri\AdminBundle\Entity\Validate::startAndEndDate($object->getStartdate(), $object->getEnddate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Check in and Check out date invalid.')));
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {
                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        }

        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestMedicalAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new \Daiquiri\ReservationBundle\Entity\MedicalRequest();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\MedicalRequestType(), $object, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::startAndEndDate($object->getStartdate(), $object->getEnddate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Check in and Check out date invalid.')));
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {
                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        }

        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestTransferExclusiveAction() {

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new \Daiquiri\ReservationBundle\Entity\TransferExclusiveRequest();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferExclusiveRequestType(), $object, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::isMoreThanMinDate($object->getStartdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Departure date invalid.')));
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {
                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        }

        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestTransferColectiveAction() {

        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new \Daiquiri\ReservationBundle\Entity\TransferColectiveRequest();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveRequestType(), $object, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::isMoreThanMinDate($object->getStartdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Departure date invalid.')));
            }
            if (!\Daiquiri\AdminBundle\Entity\Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {
                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        }

        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestPackageAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new PackageRequest();
        $form = $this->createForm(new PackageRequestType(), $object, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }
            if (!Validate::isMoreThanMinDate($object->getStartdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Check in and Check out date invalid.')));
            }
            if (!Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {

                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        } else {
            return new Response(json_encode(array('success' => false, 'content' => 'Form is invalid.')));
        }


        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestExcursionColectiveAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new \Daiquiri\ReservationBundle\Entity\ExcursionRequest();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionRequestType(), $object, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }
            if (!Validate::isMoreThanMinDate($object->getStartdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Check in and Check out date invalid.')));
            }
            if (!Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {

                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        } else {
            return new Response(json_encode(array('success' => false, 'content' => 'Form is invalid.')));
        }


        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestExcursionExclusiveAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new \Daiquiri\ReservationBundle\Entity\ExcursionRequest();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionRequestType(), $object, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }
            if (!Validate::isMoreThanMinDate($object->getStartdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Check in and Check out date invalid.')));
            }
            if (!Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {

                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        } else {
            return new Response(json_encode(array('success' => false, 'content' => 'Form is invalid.')));
        }


        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function RequestCircuitAction() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $object = new \Daiquiri\ReservationBundle\Entity\CircuitRequest();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\CircuitRequestType(), $object, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $object->setIpclient($this->getRequest()->getClientIp());
            $object->setCreateAt(new \DateTime('now'));
            $isFullyAuthenticated = $this->get('security.context')
                    ->isGranted('IS_AUTHENTICATED_FULLY');
            if ($isFullyAuthenticated) {
                $object->setPaxname($this->getUser()->getFirstName() ? $this->getUser()->getFirstName() : $this->getUser()->getUserName());
                $object->setPaxlastname($this->getUser()->getlastName() ? $this->getUser()->getLastName() : $this->getUser()->getUserName());
                $object->setPaxemail($this->getUser()->getEmail());
            }
            if (!Validate::isMoreThanMinDate($object->getStartdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'Check in and Check out date invalid.')));
            }
            if (!Validate::datebirthDate($object->getBirthdate())) {
                return new Response(json_encode(array('success' => false, 'content' => 'BirthDate is invalid.')));
            }
            if (sha1($object->getCaptcha()) == $this->getRequest()->getSession()->get('captcha')) {
                if ($this->SendRequestToAgent($object)) {
                    $object->setSendagentrequest(true);
                }
                if ($this->SendRequestToClient($object)) {
                    $object->setSendclientrequest(true);
                }
                $em->persist($object);
                $em->flush();
//                    return $this->SendRequestToAgent($object);
                return new Response(json_encode(array('success' => true, 'content' => 'Request send successfull. Agent has been notificate')));
            } else {
                return new Response(json_encode(array('success' => false, 'content' => 'Captcha is invalid.')));
            }
        }

        return new Response(json_encode(array('success' => false, 'content' => 'Form is not Valid. Please check all field.')));
    }

    public function SendRequestToClient(\Daiquiri\ReservationBundle\Entity\Request $request) {
//        return $this->render(
//                        'DaiquiriReservationBundle:EmailTemplate:request_email_to_agent.html.twig', array('request' => $request)
//        );

        $em = $this->getDoctrine()->getManager();
        $name = $this->get('translator')->trans("BOOKING DAIQUIRI TOURS CUBA", array(), 'email');
        $subject = $this->get('translator')->trans("This is a notification message from a new request in website www.daiquiricuba.com", array(), 'email');
        //$pdf = $this->forward('DaiquiriReservationController:Sale:genereVoucherBySale', array('id' => $sale->getId()));
        $mensaje = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array($this->getParameter('mailer_user') => $name))
                ->setTo('dlespinosa365@gmail.com')
                ->addTo($request->getPaxemail())
                ->setBody(
                $this->renderView(
                        'DaiquiriReservationBundle:EmailTemplate:request_email_to_client.html.twig', array('request' => $request, 'client' => false)
                ), 'text/html'
        );


        if ($this->get('mailer')->send($mensaje)) {
            return true;
        }
        return false;
    }

    public function SendRequestToAgent(\Daiquiri\ReservationBundle\Entity\Request $request) {
//        return $this->render(
//                        'DaiquiriReservationBundle:EmailTemplate:request_email_to_agent.html.twig', array('request' => $request)
//        );

        $em = $this->getDoctrine()->getManager();
        $name = $this->get('translator')->trans("BOOKING DAIQUIRI TOURS CUBA", array(), 'email');
        $subject = $this->get('translator')->trans("This is a notification message from a new request in website www.daiquiricuba.com", array(), 'email');
        //$pdf = $this->forward('DaiquiriReservationController:Sale:genereVoucherBySale', array('id' => $sale->getId()));
        $mensaje = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array($this->getParameter('mailer_user') => $name))
                ->setTo('dlespinosa365@gmail.com')
                //->addTo('booking@daiquiricuba.com')
                ->setBody(
                $this->renderView(
                        'DaiquiriReservationBundle:EmailTemplate:request_email_to_agent.html.twig', array('request' => $request, 'client' => true)
                ), 'text/html'
        );
        $users = $em->getRepository('DaiquiriAdminBundle:DUser')->findAll();
        $agentg = $em->getRepository('ApplicationSonataUserBundle:Group')->findOneBy(array('name' => 'AGENT'));

        foreach ($users as $u) {
            if ($u->getGroups()->contains($agentg)) {//              
                $mensaje->addTo($u->getEmail());
            }
        }
        if ($this->get('mailer')->send($mensaje)) {
            return true;
        }
        return false;
    }

}
