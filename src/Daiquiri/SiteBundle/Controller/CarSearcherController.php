<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Daiquiri\ReservationBundle\Entity\CarSearcher;
use Daiquiri\SiteBundle\Form\CarSearcherType;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

/**
 * CarSearcher controller.
 *
 */
class CarSearcherController extends Controller {

    /**
     * Displays a form to create a new CarSearcher entity.
     *
     */
    public function newAction() {
        $entity = new CarSearcher();
        $form = $this->createCreateForm($entity);

        return $this->render('DaiquiriSiteBundle:Car:form.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    public function listAction($page) {
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Car');
        $query = $repository->createQueryBuilder('c')
                ->where('c.available = TRUE')
                ->orderBy('c.priority', 'ASC')
                ->getQuery();

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(2);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }


        return $this->render('DaiquiriSiteBundle:Car:list.html.twig', array(
                    'salida' => $pagerfanta
        ));
    }

    public function listByCategoryAction($category, $page) {

        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('DaiquiriAdminBundle:CarCategory')->findOneBySlug($category);

        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Car');
        $query = $repository->createQueryBuilder('c')
                ->where('c.available = TRUE AND c.carCategory = :category')
                ->orderBy('c.priority', 'ASC')
                ->setParameter('category', $category)
                ->getQuery();
        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }
        return $this->render('DaiquiriSiteBundle:Car:list.html.twig', array(
                    'salida' => $pagerfanta,
                    'category' => $category
        ));
    }

    public function searchAction(Request $request, $page) {
        $entity = new CarSearcher();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $entity->setCreateAt(new \DateTime('now'));
            $entity->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $session = $request->getSession();
            $session->set('searcher', $entity->getId());
        }
        $request->request->set('_locale', $request->getLocale());
        $request->request->set('_route', $request->get('_route'));
        $request->request->set('_route_params', array('_locale' => $request->getLocale()));
        $request->request->set('_sonata_admin', 'admin.car.searcher');
        return $this->forward('DaiquiriReservationBundle:CarSearcher:initSearcher', array(
                    'page' => $page,
                    'view_render' => 'DaiquiriSiteBundle:Car:search_result.html.twig'
        ));
    }

    public function getCarsCategoriesSlugAndTitleAction() {
        $em = $this->getDoctrine()->getManager();
        $carCategories = $em->getRepository('DaiquiriAdminBundle:CarCategory')->findBy(array(), array('priority' => 'ASC'));
        $list = array();
        foreach ($carCategories as $category) {
            $list[] = array('slug' => $category->getSlug(), 'title' => $category->getTitle());
        }

        return $this->render('DaiquiriSiteBundle:Car:sub_menu.html.twig', array(
                    'list' => $list
        ));
    }

    public function showCarAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('DaiquiriAdminBundle:Car')->findOneBySlug($slug);
        return $this->render('DaiquiriSiteBundle:Car:show.html.twig', array(
                    'car' => $car
        ));
    }

    public function renderResultItemCarAction($item) {
        $admin = $this->get('admin.car');
        $item['admin'] = $admin;
        return $this->render('DaiquiriSiteBundle:Car:result_item_car.html.twig', $item);
    }

    /**
     * Lists all CarSearcher entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DaiquiriSiteBundle:CarSearcher')->findAll();

        return $this->render('DaiquiriSiteBundle:CarSearcher:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new CarSearcher entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new CarSearcher();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carsearcher_show', array('id' => $entity->getId())));
        }

        return $this->render('DaiquiriSiteBundle:CarSearcher:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CarSearcher entity.
     *
     * @param CarSearcher $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CarSearcher $entity) {
        $form = $this->createForm(new CarSearcherType(), $entity, array(
            //'action' => $this->generateUrl('carsearcher_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

}
