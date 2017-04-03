<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Daiquiri\ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Acl\Exception\Exception;
use Swift_Attachment;

/**
 * Description of PamController
 *
 * @author denis
 */
class ConfigurationPamController extends \Sonata\AdminBundle\Controller\CRUDController {

    private function checkResponsePanAction($response) {
        $status = false;
        $response_string = $response;
        $response = $response + 0;
        $msg = '';
        if ($response >= 0 && $response <= 99) {
            $msg = "Transacción autorizada para pagos y preautorizaciones";
            $status = true;
        } else if ($response == 900) {
            $msg = "Transacción autorizada para devoluciones y confirmaciones";
        } else if ($response == 101) {
            $msg = "Tarjeta caducada";
        } else if ($response == 102) {
            $msg = "Tarjeta en excepción transitoria o bajo sospecha de fraude";
        } else if ($response == 116) {
            $msg = "Disponible insuficiente";
        } else if ($response == 118) {
            $msg = "Tarjeta no registrada";
        } else if ($response == 104 || $response == 9104) {
            $msg = "Operacion no permitida para esa targeta o terminal";
        } else if ($response == 129) {
            $msg = "Código de seguridad (CVV2/CVC2) incorrecto";
        } else if ($response == 180) {
            $msg = "Tarjeta ajena al servicio";
        } else if ($response == 184) {
            $msg = "Error en la autenticación del titular";
        } else if ($response == 190) {
            $msg = "Denegación sin especificar motivo";
        } else if ($response == 191) {
            $msg = "Fecha de caducidad errónea";
        } else if ($response == 202) {
            $msg = "Tarjeta en excepción transitoria o bajo sospecha de fraude con retirada detarjeta";
        } else if ($response == 912 || $response == 9912) {
            $msg = "Emisor no disponible";
        } else if ($response == 913) {
            $msg = "Pedido repetido";
        } else
            $msg = "Causa Desconocida";
        return array('msg' => $msg, 'status' => $status);
    }

    public function ResponsePamAction() {
        $request = $this->getRequest();
        $date = $request->get('Ds_Date');
        $time = $request->get('Ds_Hour');
        $orderid = $request->get('Ds_Order');
        $firma_response = $request->get('Ds_Signature');
        $response = $request->get('Ds_Response');
        $country = $request->get('Ds_Card_Country');
        $auth_code = $request->get('Ds_AuthorisationCode');
        $card_type = $request->get('Ds_Card_Type');
        $em = $this->getDoctrine()->getManager();
        $sale = $em->getRepository('DaiquiriReservationBundle:Sale')->findOneByOrderid($orderid);
        $msg_retorno = "|recibido order id: " . $orderid . '|';
        $config = $this->getDefaulConfigurationPam();
        if ($sale) {
            $msg_retorno.="|exist sale with id: " . $sale->getId() . '|';
            print 'bult firm with : AMOUNT: ' . $sale->getAmount() * 100 . ' ORDERID: ' . $sale->getOrderId() . ' RESPONSE: ' . $response . ' CLAVE: ' . $config->getKey($sale->getCurrency()->getNomenclator());
            $firma = md5($sale->getAmount() * 100 . $sale->getOrderId() . $response . $config->getKey($sale->getCurrency()->getNomenclator()));
            if ($firma == $firma_response) {
                $msg_retorno.="|firm macth: " . $firma . '|';
                if ($this->checkResponsePanAction($response)['status']) {
                    $sale->setResponse($response);
                    $sale->setCardCountry($country);
                    $sale->setAuthCode($auth_code);
                    $sale->setCardType($card_type);
                    $sale->setDescription($this->checkResponsePanAction($response)['msg']);
                    $em->persist($sale);
                    $em->flush();
                    foreach ($sale->getServices() as $s) {
                        $s->getCartitem()->getProduct()->incrementNumberofSale();
                        $em->persist($s);
                    }
                    $em->flush();                  

                    if ($this->sendEmailToClientAction($sale)) {
                        $msg_retorno.="| mail send to client : " . $sale->getClient()->getEmail() . '|';
                    } else {
                        $msg_retorno.="| ERROR TO SEND MAIL TO CLIENT |" . $sale->getClient()->getEmail();
                    }
                    if ($this->sendEmailToAgentAction($sale)) {
                        $msg_retorno.="| mail send to agent : " . $sale->getClient()->getEmail() . '|';
                    } else {
                        $msg_retorno.="| ERROR TO SEND MAIL TO AGENT |" . $sale->getClient()->getEmail();
                    }
                    $msg_retorno.="|update sale: " . $sale->getId() . '|';
                    return new Response($msg_retorno);
                } else {
                    $msg_retorno.="| NO RESPONSE VALID MSG |" . $this->checkResponsePanAction($response)['msg'];
                    return new Response($msg_retorno);
                }
            } else {
                $msg_retorno.="| NO MACTH FIRM |";
                return new Response($msg_retorno);
            }
        } else {
            $msg_retorno.="| NO FOUND SALE WITH ORDER ID :" . $orderid . " |";
            return new Response($msg_retorno);
        }
        return new Response($msg_retorno);
    }

    public function PaymentOkAction($orderid) {

        $em = $this->getDoctrine()->getManager();
        $sale = $em->getRepository('DaiquiriReservationBundle:Sale')->findOneBy(array('orderid' => $orderid));

        $user = $this->getUser();
        $direrence = date_diff($sale->getDate(), new \DateTime('now'))->format('%y') * 365 * 25 + date_diff($sale->getDate(), new \DateTime('now'))->format('%d') * 24 + date_diff($sale->getDate(), new \DateTime('now'))->format('%h');

        // comprobar que la venta exista
        if ($sale) {
            //comprobar que la venta este asociada al usuarion que esta logueado
            if ($sale->getClient()->getId() == $user->getId()) {
                //comprobar que sea accede al link de la venta en menos de una hora de la hora en que se realiza la misma
                if ($direrence < 5) {
                    //return $this->sendEmailToAgentAction($sale); prueba de envio de correo
                    //vacio el carrito de compras
                    $this->get('reservation.cartitem')->createNewAction($this->getRequest());
                    return $this->render('Daiquiri' . $this->getRequest()->get('b') . 'Bundle:' . $this->getRequest()->get('f') . ':' . $this->getRequest()->get('vo') . '.html.twig', array(
                                'sale' => $sale
                                    )
                    );
                } else {
                    throw $this->createNotFoundException("ya expiro el link");
                }
            } else {
                throw $this->createNotFoundException(" esta venta no es tuya");
            }
        } else {
            throw $this->createNotFoundException('la venta no existe');
        }
    }

    public function PaymentFailAction($orderid = null) {
        $em = $this->getDoctrine()->getManager();
        $sale = $em->getRepository('DaiquiriReservationBundle:Sale')->findOneByOrderid($orderid);
        // comprobar que la venta exista
        if ($sale) {
            $user = $this->getUser();
            $direrence = date_diff($sale->getDate(), new \DateTime('now'))->format('%y') * 365 * 25 + date_diff($sale->getDate(), new \DateTime('now'))->format('%d') * 24 + date_diff($sale->getDate(), new \DateTime('now'))->format('%h');
            //comprobar que la venta este asociada al usuarion que esta logueado
            if ($sale->getClient()->getId() == $user->getId()) {
                //comprobar que sea accede al link de la venta en menos de una hora de la hora en que se realiza la misma
                if ($direrence < 5) {
                    return $this->render('Daiquiri' . $this->getRequest()->get('b') . 'Bundle:' . $this->getRequest()->get('f') . ':' . $this->getRequest()->get('vf') . '.html.twig', array(
                                'sale' => $sale
                                    )
                    );
                } else {
                    throw $this->createNotFoundException("expiro el link");
                }
            } else {
                throw $this->createNotFoundException("esta venta no es tuya");
            }
        } else {
            throw $this->createNotFoundException("la venta no existe");
        }
    }

    public function getDefaulConfigurationPam() {
        $em = $this->getDoctrine()->getManager();
        $c = $em->getRepository('DaiquiriReservationBundle:ConfigurationPam')->findOneBy(array('title' => 'pam_test'));
        if (!$c) {
            $c = new \Daiquiri\ReservationBundle\Entity\ConfigurationPam();
            $c->setUrlRecive('/sale-payment/response');
            $c->setUrlKo('/sale-payment/fail');
            $c->setUrlOk('/sale-payment/ok');
            $c->setAbsoluteDir('http://localhost:8090/app_dev.php/');
            $c->setComercio('Daiquiri Tours Cuba');
            $c->setKeyPamEur('clave_en_eur');
            $c->setKeyPamUsd('clave_en_usd');
            $c->setTax(6);
            $c->setCompanyName('PamInt S.A');
            $c->setCodePamEur(978);
            $c->setCodePamUsd(840);
            $c->setTitle('pam_test');
            $c->setPasarela('http://localhost:9000/index.php');
            $em->persist($c);
            $em->flush();
        }
        return $c;
    }

    public function getFormViewToSendPamAction($id, $bundle, $folder, $view_ok, $view_fail) {
        $em = $this->getDoctrine()->getManager();
        $sale = $em->getRepository('DaiquiriReservationBundle:Sale')->find($id);
        $bundle = $this->getRequest()->get('bundle');
        $folder = $this->getRequest()->get('folder');
        $view = $this->getRequest()->get('view');
        if ($sale) {
            // $pam = $this->get('admin.configurationpam');
            $config = $this->getDefaulConfigurationPam();

            $prefix_route = $config->getAbsoluteDir() . $this->getRequest()->getLocale();
            $salida = $this->renderView('DaiquiriReservationBundle:Sale:form_pam.html.twig', array(
                'action' => $config->getPasarela(),
                'amount' => $sale->getAmount() * 100,
                'orderid' => $sale->getOrderId(),
                'description' => $sale->getDescription(),
                'titular' => $sale->getClient()->getFullName(),
                'url_ok' => $prefix_route . $config->getUrlOk() . '/' . $sale->getOrderId() . '?b=' . $bundle . '&f=' . $folder . '&vo=' . $view_ok,
                'url_ko' => $prefix_route . $config->getUrlKo() . '/' . $sale->getOrderId() . '?b=' . $bundle . '&f=' . $folder . '&vf=' . $view_fail,
                'merchant' => $config->getComercio(),
                'languaje' => $this->getRequest()->getLocale(),
                'signature' => md5($sale->getAmount() * 100 . $sale->getOrderId() . $config->getKey($sale->getCurrency()->getNomenclator())),
                'currency' => $sale->getCurrency()->getCode(),
                'url_confirm' => $prefix_route . $config->getUrlRecive() . '/' . $sale->getOrderId()
            ));
            return new Response($salida);
        }
        return new Response("No comunicate with server");
    }

    public function sendEmailToClientAction($sale) {
//        return $this->render(
//                        // app/Resources/views/Emails/registration.html.twig
//                        'DaiquiriReservationBundle:EmailTemplate:sale_email_to_client.html.twig', array('sale' => $sale)
//        );
        $name = $this->get('translator')->trans("BOOKING DAIQUIRI TOURS CUBA", array(), 'email');
        $subject = $this->get('translator')->trans("This is a notification message from a new booking in website www.daiquiricuba.com", array(), 'email');
        $pdf = $this->forward('DaiquiriReservationController:Sale:genereVoucherBySale', array('id' => $sale->getId()));
        $mensaje = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array($this->getParameter('mailer_user') => $name))
                ->setTo($sale->getClient()->getEmail())
                ->setBody(
                        $this->renderView(
                                // app/Resources/views/Emails/registration.html.twig
                                'DaiquiriReservationBundle:EmailTemplate:sale_email_to_client.html.twig', array('sale' => $sale)
                        ), 'text/html'
                )
                ->attach(Swift_Attachment::newInstance($pdf, 'DTC_' . $sale->getOrderid() . '.pdf', 'application/pdf'))

        ;

        if ($this->get('mailer')->send($mensaje)) {
            return true;
        }
        return false;
    }

    public function sendEmailToAgentAction($sale) {
        $em = $this->getDoctrine()->getManager();
//        return $this->render(
//                        'DaiquiriReservationBundle:EmailTemplate:sale_email_to_agent.html.twig', array('sale' => $sale)
//        );
        $name = $this->get('translator')->trans("BOOKING DAIQUIRI TOURS CUBA", array(), 'email');
        $subject = $this->get('translator')->trans("This is a notification message from a new booking in website www.daiquiricuba.com", array(), 'email');
        //$pdf = $this->forward('DaiquiriReservationController:Sale:genereVoucherBySale', array('id' => $sale->getId()));
        $mensaje = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array($this->getParameter('mailer_user') => $name))
                ->setTo('dlespinosa365@gmail.com')
                ->addTo('booking@daiquiricuba.com')
                ->setBody(
                $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                        'DaiquiriReservationBundle:EmailTemplate:sale_email_to_agent.html.twig', array('sale' => $sale)
                ), 'text/html'
        );
        $users = $em->getRepository('ApplicationSonataUserBundle:User')->findAll();
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

    /////////////////////////////////////////////////
    public function getFormViewToSendPamPaymentAction($id, $bundle, $folder, $view_ok, $view_fail) {

        $em = $this->getDoctrine()->getManager();
        $payment = $em->getRepository('DaiquiriAdminBundle:Payment')->find($id);
        $bundle = $this->getRequest()->get('bundle');
        $folder = $this->getRequest()->get('folder');
        $view = $this->getRequest()->get('view');
        if ($payment) {
            // $pam = $this->get('admin.configurationpam');
            $config = $this->getDefaulConfigurationPaymentPam();

            $prefix_route = $config->getAbsoluteDir() . $this->getRequest()->getLocale();
            return $this->render('DaiquiriAdminBundle:Payment:form_pam.html.twig', array(
                        'action' => $config->getPasarela(),
                        'amount' => $payment->getAmount() * 100,
                        'orderid' => $payment->getOrderId(),
                        'description' => strip_tags($payment->getDescription()),
                        'titular' => $payment->getClient()->getFullName(),
                        'url_ok' => $prefix_route . $config->getUrlOk() . '/' . $payment->getOrderId() . '?b=' . $bundle . '&f=' . $folder . '&vo=' . $view_ok,
                        'url_ko' => $prefix_route . $config->getUrlKo() . '/' . $payment->getOrderId() . '?b=' . $bundle . '&f=' . $folder . '&vf=' . $view_fail,
                        'merchant' => $config->getComercio(),
                        'languaje' => $this->getRequest()->getLocale(),
                        'signature' => md5($payment->getAmount() * 100 . $payment->getOrderId() . $config->getKey($payment->getCurrency()->getNomenclator())),
                        'currency' => $payment->getCurrency()->getCode(),
                        'url_confirm' => $prefix_route . $config->getUrlRecive() . '/' . $payment->getOrderId()
            ));
        }
        return new Response("No comunicate with server");
    }

    public function PaymentResponsePamAction() {
        $request = $this->getRequest();
        $date = $request->get('Ds_Date');
        $time = $request->get('Ds_Hour');
        $orderid = $request->get('Ds_Order');
        $firma_response = $request->get('Ds_Signature');
        $response = $request->get('Ds_Response');
        $country = $request->get('Ds_Card_Country');
        $auth_code = $request->get('Ds_AuthorisationCode');
        $card_type = $request->get('Ds_Card_Type');
        $em = $this->getDoctrine()->getManager();
        $pay = $em->getRepository('DaiquiriAdminBundle:Payment')->findOneByOrderId($orderid);
        $msg_retorno = "|recibido order id: " . $orderid . '|';
        $config = $this->getDefaulConfigurationPaymentPam();
        if ($pay) {
            $msg_retorno.="|exist sale with id: " . $pay->getId() . '|';
            print 'bult firm with : AMOUNT: ' . $pay->getAmount() * 100 . ' ORDERID: ' . $pay->getOrderId() . ' RESPONSE: ' . $response . ' CLAVE: ' . $config->getKey($pay->getCurrency()->getNomenclator());
            $firma = md5($pay->getAmount() * 100 . $pay->getOrderId() . $response . $config->getKey($pay->getCurrency()->getNomenclator()));
            if ($firma == $firma_response) {
                $msg_retorno.="|firm macth: " . $firma . '|';
                if ($this->checkResponsePanAction($response)['status']) {
                    $pay->setResponse($response);
                    $pay->setCardCountry($country);
                    $pay->setAuthCode($auth_code);
                    $pay->setCardType($card_type);
                    $pay->setError($this->checkResponsePanAction($response)['msg']);
                    $em->persist($pay);
                    $em->flush();

                    if ($this->sendEmailToClientPaymentAction($pay)) {
                        $msg_retorno.="| mail send to client : " . $pay->getClient()->getEmail() . '|';
                    } else {
                        $msg_retorno.="| ERROR TO SEND MAIL TO CLIENT |" . $pay->getClient()->getEmail();
                    }
                    if ($this->sendEmailToAgentPaymentAction($pay)) {
                        $msg_retorno.="| mail send to agent : " . $pay->getClient()->getEmail() . '|';
                    } else {
                        $msg_retorno.="| ERROR TO SEND MAIL TO AGENT |" . $pay->getClient()->getEmail();
                    }
                    $msg_retorno.="|update sale: " . $pay->getId() . '|';
                    return new Response($msg_retorno);
                } else {
                    $msg_retorno.="| NO RESPONSE VALID MSG |" . $this->checkResponsePanAction($response)['msg'];
                    return new Response($msg_retorno);
                }
            } else {
                $msg_retorno.="| NO MACTH FIRM |";
                return new Response($msg_retorno);
            }
        } else {
            $msg_retorno.="| NO FOUND SALE WITH ORDER ID :" . $orderid . " |";
            return new Response($msg_retorno);
        }
        return new Response($msg_retorno);
    }

    public function sendEmailToAgentPaymentAction($payment) {
        $em = $this->getDoctrine()->getManager();
        return $this->render(
                        'DaiquiriReservationBundle:EmailTemplate:payment_email_to_agent.html.twig', array('payment' => $payment)
        );
        $name = $this->get('translator')->trans("BOOKING DAIQUIRI TOURS CUBA", array(), 'email');
        $subject = $this->get('translator')->trans("This is a notification message from a new booking in website www.daiquiricuba.com", array(), 'email');
        //$pdf = $this->forward('DaiquiriReservationController:Sale:genereVoucherBySale', array('id' => $sale->getId()));
        $mensaje = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array($this->getParameter('mailer_user') => $name))
                ->setTo('dlespinosa365@gmail.com')
                ->addTo('booking@daiquiricuba.com')
                ->setBody(
                $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                        'DaiquiriReservationBundle:EmailTemplate:payment_email_to_agent.html.twig', array('payment' => $payment)
                ), 'text/html'
        );
        $users = $em->getRepository('ApplicationSonataUserBundle:User')->findAll();
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

    public function sendEmailToClientPaymentAction($payment) {
        return $this->render(
                        // app/Resources/views/Emails/registration.html.twig
                        'DaiquiriReservationBundle:EmailTemplate:payment_email_to_client.html.twig', array('payment' => $payment)
        );
        $name = $this->get('translator')->trans("BOOKING DAIQUIRI TOURS CUBA", array(), 'email');
        $subject = $this->get('translator')->trans("This is a notification message from a new payment in website www.daiquiricuba.com", array(), 'email');

        $mensaje = \Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom(array($this->getParameter('mailer_user') => $name))
                ->setTo($payment->getClient()->getEmail())
                ->setBody(
                $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                        'DaiquiriReservationBundle:EmailTemplate:payment_email_to_client.html.twig', array('payment' => $payment)
                ), 'text/html'
                )

        ;

        if ($this->get('mailer')->send($mensaje)) {
            return true;
        }
        return false;
    }

    public function PaymentOkPaymentAction($orderid) {

        $em = $this->getDoctrine()->getManager();
        $pay = $em->getRepository('DaiquiriAdminBundle:Payment')->findOneBy(array('orderId' => $orderid));

        $user = $this->getUser();
        $direrence = date_diff($pay->getDateCreated(), new \DateTime('now'))->format('%y') * 365 * 25 + date_diff($pay->getDateCreated(), new \DateTime('now'))->format('%d') * 24 + date_diff($pay->getDateCreated(), new \DateTime('now'))->format('%h');

        // comprobar que la venta exista
        if ($pay) {
            //comprobar que la venta este asociada al usuarion que esta logueado
            if ($pay->getClient()->getId() == $user->getId()) {
                //comprobar que sea accede al link de la venta en menos de una hora de la hora en que se realiza la misma
                if ($direrence < 5) {

                    //return $this->sendEmailToAgentAction($sale); prueba de envio de correo                    
                    return $this->render('Daiquiri' . $this->getRequest()->get('b') . 'Bundle:' . $this->getRequest()->get('f') . ':' . $this->getRequest()->get('vo') . '.html.twig', array(
                                'payment' => $pay
                                    )
                    );
                } else {
                    throw $this->createNotFoundException("ya expiro el link");
                }
            } else {
                throw $this->createNotFoundException(" el pago no es tuya");
            }
        } else {
            throw $this->createNotFoundException('el pago no existe');
        }
    }

    public function PaymentFailPaymentAction($orderid = null) {
        $em = $this->getDoctrine()->getManager();
        $pay = $em->getRepository('DaiquiriAdminBundle:Payment')->findOneByOrderId($orderid);
        // comprobar que la venta exista
        if ($pay) {
            $user = $this->getUser();
            $direrence = date_diff($pay->getDateCreated(), new \DateTime('now'))->format('%y') * 365 * 25 + date_diff($pay->getDateCreated(), new \DateTime('now'))->format('%d') * 24 + date_diff($pay->getDateCreated(), new \DateTime('now'))->format('%h');
            //comprobar que la venta este asociada al usuarion que esta logueado
            if ($pay->getClient()->getId() == $user->getId()) {
                //comprobar que sea accede al link de la venta en menos de una hora de la hora en que se realiza la misma
                if ($direrence < 5) {
                    return $this->render('Daiquiri' . $this->getRequest()->get('b') . 'Bundle:' . $this->getRequest()->get('f') . ':' . $this->getRequest()->get('vf') . '.html.twig', array(
                                'payment' => $pay
                                    )
                    );
                } else {
                    throw $this->createNotFoundException("expiro el link");
                }
            } else {
                throw $this->createNotFoundException("el pago no es tuya");
            }
        } else {
            throw $this->createNotFoundException("el pago no existe");
        }
    }

    public function getDefaulConfigurationPaymentPam() {
        $em = $this->getDoctrine()->getManager();
        $c = $em->getRepository('DaiquiriReservationBundle:ConfigurationPam')->findOneBy(array('title' => 'pam_test_payment'));
        if (!$c) {
            $c = new \Daiquiri\ReservationBundle\Entity\ConfigurationPam();
            $c->setUrlRecive('/payment/response');
            $c->setUrlKo('/payment/fail');
            $c->setUrlOk('/payment/ok');
            $c->setAbsoluteDir('http://localhost:8090/app_dev.php/');
            $c->setComercio('Daiquiri Tours Cuba');
            $c->setKeyPamEur('clave_en_eur');
            $c->setKeyPamUsd('clave_en_usd');
            $c->setTax(6);
            $c->setCompanyName('PamInt S.A');
            $c->setCodePamEur(978);
            $c->setCodePamUsd(840);
            $c->setTitle('pam_test_payment');
            $c->setPasarela('http://localhost:9000/index.php');
            $em->persist($c);
            $em->flush();
        }
        return $c;
    }

    //put your code here
}
