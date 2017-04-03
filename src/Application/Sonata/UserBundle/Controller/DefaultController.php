<?php

namespace Application\Sonata\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function checkUsernameAction($username) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApplicationSonataUserBundle:User')->findOneByUsername($username);
        if ($user) {
            return new Response(json_encode(array('success' => true)));
        } else {
            return new Response(json_encode(array('success' => false)));
        }
    }
    
    public function checkEmailAction($email) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApplicationSonataUserBundle:User')->findOneByEmail($email);
        if ($user) {
            return new Response(json_encode(array('success' => true)));
        } else {
            return new Response(json_encode(array('success' => false)));
        }
    }

}
