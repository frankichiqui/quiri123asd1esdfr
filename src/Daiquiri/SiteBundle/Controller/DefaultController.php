<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

class DefaultController extends Controller {

    public function indexAction() {
        $this->getRequest()->getSession()->remove('searcher');
        return $this->render('DaiquiriSiteBundle:Default:index.html.twig', array());
    }

    public function changeCurrencyUSDAction() {
        $this->getRequest()->getSession()->remove('searcher');
        $this->getRequest()->getSession()->set('currency', 'usd');
        return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true)));
    }

    public function changeCurrencyEURAction() {
        $this->getRequest()->getSession()->remove('searcher');
        $this->getRequest()->getSession()->set('currency', 'eur');
        return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true)));
    }

    public function about_usAction() {
        return $this->render('DaiquiriSiteBundle:Static:aboutus.html.twig');
    }

    public function faqsAction($page) {
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Faq');
        $query = $repository->createQueryBuilder('f')
                ->orderBy('f.priority', 'ASC')
                ->getQuery();

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }


        return $this->render('DaiquiriSiteBundle:Static:faq.html.twig', array(
                    'salida' => $pagerfanta
        ));

    }

    public function contact_usAction() {
        $m = $this->getRequest()->get('m', null);
        return $this->render('DaiquiriSiteBundle:Static:contactus.html.twig', array(
                    'form' => $this->createForm(new \Daiquiri\SiteBundle\Form\ContactType())->createView(),
                    'm' => $m
        ));
    }

    public function formReview() {
        return $this->get('admin.review')->getForm();
    }

    public function reviewAdmin() {
        return $this->get('admin.review');
    }

    public function reviewObject() {
        return new \Daiquiri\AdminBundle\Entity\Review();
    }

    public function getTokenAction() {
        return new Response($this->container->get('form.csrf_provider')
                        ->generateCsrfToken('authenticate'));
    }

    public function getReviews() {
        $em = $this->getDoctrine()->getManager();
        return $em->getRepository('DaiquiriAdminBundle:Review')->findAll();
    }

}
