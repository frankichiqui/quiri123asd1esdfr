<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Daiquiri\ReservationBundle\Entity\ExcursionSearcher;
use Daiquiri\SiteBundle\Form\ExcursionSearcherType;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

/**
 * ExcursionSearcher controller.
 *
 */
class ExcursionSearcherController extends Controller {

    /**
     * Displays a form to create a new ExcursionSearcher entity.
     *
     */
    public function newAction() {
        $entity = new ExcursionSearcher();
        $form = $this->createCreateForm($entity);

        return $this->render('DaiquiriSiteBundle:Excursion:form.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function listAction($page) {

        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Excursion');

        $query = $repository->createQueryBuilder('e')
                ->where('e.available = TRUE')
                ->orderBy('e.priority', 'ASC')
                ->getQuery();

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        //dump($pagerfanta);die;

        return $this->render('DaiquiriSiteBundle:Excursion:list.html.twig', array(
                    'salida' => $pagerfanta,
        ));
    }

    public function listByPoloAction($polo, $page) {
        $em = $this->getDoctrine()->getManager();
        $polo = $em->getRepository('DaiquiriAdminBundle:Polo')->findOneBySlug($polo);
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Excursion');
        $query = $repository->createQueryBuilder('e')
                ->where('e.available = TRUE AND e.polofrom = :polo')
                ->orderBy('e.priority', 'ASC')
                ->setParameter('polo', $polo)
                ->getQuery();
        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        //dump($pagerfanta);die;

        return $this->render('DaiquiriSiteBundle:Excursion:list.html.twig', array(
                    'salida' => $pagerfanta,
                    'polo' => $polo
        ));
    }

    public function searchAction(Request $request, $page) {

        $entity = new ExcursionSearcher();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        /* dump($request);
          dump($form);
          dump($form->isValid());die; */

        if ($form->isValid()) {
            $entity->setCreateAt(new \DateTime('now'));
            $entity->setUser($this->getUser());
            //$entity->setBetweendates(null);

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            //dump($entity->getId()); die;
            $session = $request->getSession();
            $session->set('searcher', $entity->getId());
        }
        $request->request->set('_locale', $request->getLocale());
        $request->request->set('_route', $request->get('_route'));
        $request->request->set('_route_params', array('_locale' => $request->getLocale()));
        $request->request->set('_sonata_admin', 'admin.excursion.searcher');
        return $this->forward('DaiquiriReservationBundle:ExcursionSearcher:initSearcher', array(
                    'page' => $page,
                    'view_render' => 'DaiquiriSiteBundle:Excursion:search_result.html.twig'
        ));
    }

    public function getExcursionsSlugAndTitleAction() {
        $em = $this->getDoctrine()->getManager();
        $excursions = $em->getRepository('DaiquiriAdminBundle:Excursion')->findBy(array('available' => true), array('priority' => 'ASC'));
        $list = array();
        foreach ($excursions as $excursion) {
            $list[] = array('slug' => $excursion->getSlug(), 'title' => $excursion->getTitle());
        }
        return $this->render('DaiquiriSiteBundle:Excursion:sub_menu.html.twig', array(
                    'list' => $list
        ));
    }

    public function getExcursionsByPoloForMenuAction() {
        $em = $this->getDoctrine()->getManager();
        $polos = $em->getRepository('DaiquiriAdminBundle:Polo')->findBy(array(), array('priority' => 'ASC'));

        $list = array();
        foreach ($polos as $polo) {
            if (count($polo->getExcursions()) > 0) {
                $tmp = array();
                foreach ($polo->getExcursions() as $excursion) {
                    $tmp[] = array('priority' => $excursion->getPriority(), 'slug' => $excursion->getSlug(), 'title' => $excursion->getTitle());
                }
                $tmp1 = $this->array_orderby($tmp, 'priority', SORT_ASC);

                array_push($list, array('polofrom' => $polo->getTitle(), 'poloslug' => $polo->getSlug(), 'excursions' => $tmp1));
            }
        }
        return $this->render('DaiquiriSiteBundle:Excursion:sub_menu.html.twig', array(
                    'list' => $list
        ));
    }

    public function array_orderby() {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }

    public function showExcursionAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $excursion = $em->getRepository('DaiquiriAdminBundle:Excursion')->findOneBySlug($slug);
        $entity = new ExcursionSearcher();
        $entity->setDate((new \DateTime('today'))->modify('+ 4 days'));
        $entity->setExcursion($excursion);
        $form = $this->createCreateForm($entity);
        return $this->render('DaiquiriSiteBundle:Excursion:show.html.twig', array(
                    'object' => $excursion,
                    'form_search' => $form->createView(),
                    'similar' => $em->getRepository('DaiquiriAdminBundle:Excursion')->findBy(array(
                        'polofrom' => $excursion->getPolofrom()->getId(),
                    )),
        ));
    }

    public function renderResultItemExcursionAction($admin, $item) {
        if ($admin == 'admin.excursioncolective') {
            $admin = $this->get('admin.excursioncolective');
        } else {
            $admin = $this->get('admin.excursionexclusive');
        }
        $item['admin'] = $admin;
        return $this->render('DaiquiriSiteBundle:Excursion:result_item_excursion.html.twig', $item);
    }

    /**
     * Lists all ExcursionSearcher entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DaiquiriSiteBundle:ExcursionSearcher')->findAll();

        return $this->render('DaiquiriSiteBundle:ExcursionSearcher:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new ExcursionSearcher entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new ExcursionSearcher();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('excursionsearcher_show', array('id' => $entity->getId())));
        }

        return $this->render('DaiquiriSiteBundle:ExcursionSearcher:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ExcursionSearcher entity.
     *
     * @param ExcursionSearcher $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ExcursionSearcher $entity) {
        $form = $this->createForm(new ExcursionSearcherType(), $entity, array(
            //'action' => $this->generateUrl('excursionsearcher_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    public function searchIntoshowAction(Request $request, $page, $slug) {
        $entity = new ExcursionSearcher();
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
            return $this->forward('DaiquiriReservationBundle:ExcursionSearcher:initSearcher', array(
                        'page' => $page,
                        '_route' => $request->get('_route'),
                        '_route_params' => $request->get('_route_params'),
                        '_locale' => $request->get('_locale'),
                        '_sonata_admin' => 'admin.ocupation.searcher',
                        'view_render' => 'DaiquiriSiteBundle:Excursion:show.html.twig',
                        'other' => array(
                            'object' => $entity->getExcursion(),
                            'similar' => $em->getRepository('DaiquiriAdminBundle:Excursion')->findBy(array(
                                'polofrom' => $entity->getExcursion()->getPolofrom()->getId())),
                            'form_search' => $form->createView()))
                    )
            ;
        }
        $this->addFlash('error', 'no valid data');
        return $this->showExcursionAction($slug);
    }

    public function createReviewToExcursionAction(Request $request) {
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
            return $this->render('DaiquiriSiteBundle:Excursion:form_to_new_review_into_product.html.twig', array('form' => $form->createView(),
                        'review' => $entity));
        }
        return new Response();
    }

}
