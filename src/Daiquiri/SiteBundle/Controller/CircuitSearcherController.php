<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Daiquiri\ReservationBundle\Entity\CircuitSearcher;
use Daiquiri\SiteBundle\Form\CircuitSearcherType;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

/**
 * CircuitSearcher controller.
 *
 */
class CircuitSearcherController extends Controller {

    /**
     * Displays a form to create a new CircuitSearcher entity.
     *
     */
    public function newAction() {

        $entity = new CircuitSearcher();
        $form = $this->createCreateForm($entity);

        return $this->render('DaiquiriSiteBundle:Circuit:form.html.twig', array(
                    'form' => $form->createView(),
                    'pickupdays' => $this->getAllPickUpDaysCircuits()
        ));
    }

    public function listAction($page) {
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Circuit');
        $query = $repository->createQueryBuilder('c')
                ->where('c.available = TRUE')
                ->orderBy('c.priority', 'ASC')
                ->getQuery();

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(9);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }


        return $this->render('DaiquiriSiteBundle:Circuit:list.html.twig', array(
                    'salida' => $pagerfanta
        ));
    }

    public function searchAction(Request $request, $page) {
        $entity = new CircuitSearcher();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        /* dump($request);
          dump($form);die; */
        if ($form->isValid()) {
            $entity->setCreateAt(new \DateTime('now'));
            $entity->setUser($this->getUser());
            //$entity->setBetweendates(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $session = $request->getSession();
            $session->set('searcher', $entity->getId());
        }
        $request->request->set('_locale', $request->getLocale());
        $request->request->set('_route', $request->get('_route'));
        $request->request->set('_route_params', array('_locale' => $request->getLocale()));
        $request->request->set('_sonata_admin', 'admin.circuit.searcher');
        return $this->forward('DaiquiriReservationBundle:CircuitSearcher:initSearcher', array(
                    'page' => $page,
                    'view_render' => 'DaiquiriSiteBundle:Circuit:search_result.html.twig',
        ));
    }

    //para obtener los dias en que salen los circuitos
    public function getAllPickUpDaysCircuits() {
        $em = $this->getDoctrine()->getManager();
        $circuits = $em->getRepository('DaiquiriAdminBundle:Circuit')->findBy(array('available' => true), array('priority' => 'ASC'));

        $days = array();
        $date = (new \DateTime('now'))->modify('+ 4 days');

        foreach ($circuits as $circuit) {
            $circuit_availabilities = $circuit->getCircuitAvailabilitys();
            foreach ($circuit_availabilities as $circuit_availability) {
                if ($date < $circuit_availability->getDate()) {
                    $days[] = $circuit_availability->getDate();
                }
            }
        }

        $aux = array();
        foreach ($days as $day) {
            $aux[] = $this->obtainDate($day);
        }


        usort($aux, function($a, $b) {
            return strcmp($a, $b);
        });


        return $aux;
    }

    public function obtainDate($val) {
        $o = new ReflectionObject($val);
        $p = $o->getProperty('date');
        return $p->getValue($val);
    }

    public function getCircuitsSlugAndTitleAction() {
        $em = $this->getDoctrine()->getManager();
        $circuits = $em->getRepository('DaiquiriAdminBundle:Circuit')->findBy(array('available' => true), array('priority' => 'ASC'));
        $list = array();
        foreach ($circuits as $circuit) {
            $list[] = array('slug' => $circuit->getSlug(), 'title' => $circuit->getTitle());
        }
        return $this->render('DaiquiriSiteBundle:Circuit:sub_menu.html.twig', array(
                    'list' => $list
        ));
    }

    public function showCircuitAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository('DaiquiriAdminBundle:Circuit')->findOneBySlug($slug);

        $entity = new CircuitSearcher();
        $entity->setDate((new \DateTime('today'))->modify('+ 4 days'));
        $entity->setCircuit($circuit);
        $form = $this->createCreateForm($entity);
        // dump($circuit);die;
        return $this->render('DaiquiriSiteBundle:Circuit:show.html.twig', array(
                    'object' => $circuit,
                    'similar' => $em->getRepository('DaiquiriAdminBundle:Circuit')->findBy(array('polofrom' => $circuit->getPolofrom()->getId())),
                    'form_search' => $form->createView()
        ));
    }

    public function renderResultItemCircuitAction($item) {
        $admin = $this->get('admin.circuit');
        $item['admin'] = $admin;
        return $this->render('DaiquiriSiteBundle:Circuit:result_item_circuit.html.twig', $item);
    }

    /**
     * Lists all CircuitSearcher entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DaiquiriReservationBundle:CircuitSearcher')->findAll();

        return $this->render('DaiquiriSiteBundle:CircuitSearcher:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new CircuitSearcher entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new CircuitSearcher();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('circuitsearcher_show', array('id' => $entity->getId())));
        }

        return $this->render('DaiquiriSiteBundle:CircuitSearcher:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CircuitSearcher entity.
     *
     * @param CircuitSearcher $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CircuitSearcher $entity) {
        $form = $this->createForm(new CircuitSearcherType(), $entity, array(
            //'action' => $this->generateUrl('circuitsearcher_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    public function searchIntoshowAction(Request $request, $page, $slug) {
        $entity = new CircuitSearcher();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
//        dump($entity);
//        die;
        if ($form->isValid()) {
            $entity->setCreateAt(new \DateTime('now'));
            $entity->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $session = $request->getSession();
            $session->set('searcher', $entity->getId());
            return $this->forward('DaiquiriReservationBundle:CircuitSearcher:initSearcher', array(
                        'page' => $page,
                        '_route' => $request->get('_route'),
                        '_route_params' => $request->get('_route_params'),
                        '_locale' => $request->get('_locale'),
                        '_sonata_admin' => 'admin.ocupation.searcher',
                        'view_render' => 'DaiquiriSiteBundle:Circuit:show.html.twig',
                        'other' => array(
                            'object' => $entity->getCircuit(),
                            'similar' => $em->getRepository('DaiquiriAdminBundle:Circuit')->findBy(array(
                                'polofrom' => $entity->getCircuit()->getPolofrom()->getId())),
                            'form_search' => $form->createView()))
                    )
            ;
        }
        dump($entity);die;
        $this->addFlash('error', 'no valid data');
        return $this->showCircuitAction($slug);
    }

    public function createReviewToCircuitAction(Request $request) {
        //dump($request);die;
        $entity = new \Daiquiri\AdminBundle\Entity\ReviewProduct();
        $entity->setUser($this->getUser());
        $form = $this->createForm(new \Daiquiri\SiteBundle\Form\ReviewProductType(), $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return new \Symfony\Component\HttpFoundation\Response(json_encode(array(
                        'success' => true,
                        'class' => 'alert-success',
            )));
        }

        return new \Symfony\Component\HttpFoundation\Response(json_encode(array(
                    'success' => false,
                    'class' => 'alert-danger',
        )));
    }

    public function getFormToNewReviewAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('DaiquiriAdminBundle:Product')->findOneBy(array('slug' => $slug));
        if ($product) {
            $entity = new \Daiquiri\AdminBundle\Entity\ReviewProduct();
            $entity->setProduct($product);
            $entity->setVotes(5);
            $form = $this->createForm(new \Daiquiri\SiteBundle\Form\ReviewProductType(), $entity);
            return $this->render('DaiquiriSiteBundle:Circuit:form_to_new_review_into_product.html.twig', array('form' => $form->createView(),
                        'review' => $entity));
        }
        return new Response();
    }

}
