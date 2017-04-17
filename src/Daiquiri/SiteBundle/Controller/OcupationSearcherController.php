<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Daiquiri\ReservationBundle\Entity\OcupationSearcher;
use Daiquiri\SiteBundle\Form\OcupationSearcherType;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

/**
 * OcupationSearcher controller.
 *
 */
class OcupationSearcherController extends Controller {

    /**
     * Displays a form to create a new OcupationSearcher entity.
     *
     */
    public function newAction() {
        $entity = new OcupationSearcher();
        $form = $this->createCreateForm($entity);

        return $this->render('DaiquiriSiteBundle:Hotel:form.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    public function listAction($page) {

        $repository = $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Hotel');
        $query = $repository->createQueryBuilder('h')
            ->where('h.available = TRUE')
            ->orderBy('h.priority', 'ASC');

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        $filterViewVars = $this->getFilterHotelVars($query);

        return $this->render('DaiquiriSiteBundle:Hotel:list.html.twig', array(
            'salida' => $pagerfanta,
            'stars' => $filterViewVars['stars'],
            'hotelFacilities' => $filterViewVars['hotelFacilities'],
            'hotelTypes' => $filterViewVars['hotelTypes'],            
        ));
    }

    public function getFilterHotelVars($query) {

        $allHotels = $query->getQuery()->getResult();
        $stars = array(
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        );

        foreach ($allHotels as $key => $hotel) {
            $starAvg = $hotel->getAverageVotes();
            $starAvg = (int)$starAvg;
            $stars[$starAvg] = $stars[$starAvg] + 1;
        }

        $vars = array(
            'stars' => $stars,
            'hotelFacilities' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:HotelFacility')->getHotelsFacilities(),
            'hotelTypes' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:HotelType')->getHotelsTypes(),
            );        

        return $vars;
    }

    public function listAjaxFilterAction($page = 1) {
        
        $idType = $this->container->get('request_stack')->getCurrentRequest()->get("idType");
        $rating = $this->container->get('request_stack')->getCurrentRequest()->get("rating");
        $sort = $this->container->get('request_stack')->getCurrentRequest()->get("sort");
        $facility = $this->container->get('request_stack')->getCurrentRequest()->get("facility");
        $filterVars = array(
            'type' => $idType,
            'rating' => $rating,
            'sort' => $sort,
            'facility' => $facility
        );

        $query = $this->resolveHotelFilter($filterVars);

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(100);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }


        return $this->render('DaiquiriSiteBundle:Hotel:ajax_hotels.html.twig', array(
            'salida' => $pagerfanta,
            'isAjax' => true,
        ));
    }

    public function resolveHotelFilter($filterVars){
        $repository = $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Hotel');
        $idType = $filterVars['type'];
        $rating = $filterVars['rating'];
        $sort =  $filterVars['sort'];
        $facility = $filterVars['facility'];

        $query = $repository->createQueryBuilder('h')
            ->leftJoin('h.reviews', 'r')
            ->leftJoin('h.hotel_facilitys', 'f')
            ->where('h.available = TRUE');

        if ($idType != -1){
            $query->andWhere('h.hotelType = :idType')
                ->setParameter("idType", $idType);
        }

        if ($rating != -1){
            $query->andWhere('h.avgReviews = :rating')
                ->setParameter("rating", $rating);
        }

        if ($facility != -1){
            $query->andWhere('f.title = :facility')
                ->setParameter("facility", $facility);
        }

        if ($sort != -1){
            switch ($sort) {
                case 1:
                    $query->orderBy('h.title', 'ASC');
                    break;
                case 2:
                    $query->orderBy('h.title', 'DESC');
                    break;
                case 3:
                    $query->orderBy('r.hotel', 'ASC');
                    break;
            }
        }


        return $query->getQuery();

    }

    public function listByPoloAction($polo, $page) {
        $em = $this->getDoctrine()->getManager();
        $polo = $em->getRepository('DaiquiriAdminBundle:Polo')->findOneBySlug($polo);
        $repository = $this->getDoctrine()
            ->getRepository('DaiquiriAdminBundle:Hotel');
        $query = $repository->createQueryBuilder('h')
            ->where('h.available = TRUE AND h.polo = :polo')
            ->orderBy('h.priority', 'ASC')
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

        return $this->render('DaiquiriSiteBundle:Hotel:list.html.twig', array(
            'salida' => $pagerfanta,
            'polo' => $polo
        ));
    }

    public function searchAction(Request $request, $page) {
        $entity = new OcupationSearcher();
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
        $request->request->set('_sonata_admin', 'admin.ocupation.searcher');
              
       

        return $this->forward('DaiquiriReservationBundle:OcupationSearcher:initSearcher', array(
            'page' => $page,
            'view_render' => 'DaiquiriSiteBundle:Hotel:search_result.html.twig',
        ));
    }

    public function getHotelsByPoloForMenuAction() {
        $em = $this->getDoctrine()->getManager();
        $polos = $em->getRepository('DaiquiriAdminBundle:Polo')->getAllDiferentPoloWithHotel();


        return $this->render('DaiquiriSiteBundle:Hotel:sub_menu.html.twig', array(
            'list' => $polos
        ));
    }

    public function renderResultOcupationItemAction($item) {
        $admin = $this->get('admin.hotel');
        $item['admin'] = $admin;
        return $this->render('DaiquiriSiteBundle:Hotel:result_item_ocupation.html.twig', $item);
    }

    /**
     * Creates a form to create a OcupationSearcher entity.
     *
     * @param OcupationSearcher $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OcupationSearcher $entity) {
        $form = $this->createForm(new OcupationSearcherType(), $entity, array(
            //'action' => $this->generateUrl('ocupationsearcher_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    public function showAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('DaiquiriAdminBundle:Hotel')->findOneBy(array('slug' => $slug));
        if (!$hotel) {
            return $this->createNotFoundException();
        }
        $entity = new OcupationSearcher();
        $entity->setStartdate((new \DateTime('today'))->modify('+ 4 days'));
        $entity->setEnddate((new \DateTime('today'))->modify('+ 5 days'));
        $entity->setHotel($hotel);
        $form = $this->createCreateForm($entity);
        return $this->render('DaiquiriSiteBundle:Hotel:show.html.twig', array(
            'hotel' => $hotel,
            'similar' => $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->findBy(array('stars' => $hotel->getStars(),
            )),
            //'review' => $hotel->getReviews(),
            'form_search' => $form->createView()));
    }

    public function searchIntoshowAction(Request $request, $page, $slug) {
        $entity = new OcupationSearcher();
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
            return $this->forward('DaiquiriReservationBundle:OcupationSearcher:initSearcher', array(
                    'page' => $page,
                    '_route' => $request->get('_route'),
                    '_route_params' => $request->get('_route_params'),
                    '_locale' => $request->get('_locale'),
                    '_sonata_admin' => 'admin.ocupation.searcher',
                    'view_render' => 'DaiquiriSiteBundle:Hotel:show.html.twig',
                    'other' => array(
                        'hotel' => $entity->getHotel(),
                        'similar' => $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->findBy(array('stars' => $entity->getHotel()->getStars())),
                        'form_search' => $form->createView()))
            )
                ;
        }
        $this->addFlash('error', 'data is invalid');
        return $this->showAction($slug);
    }

    public function createReviewToHotelAction(Request $request) {
        //dump($request);die;
        $entity = new \Daiquiri\AdminBundle\Entity\ReviewHotel();
        $entity->setUser($this->getUser());
        $form = $this->createForm(new \Daiquiri\SiteBundle\Form\ReviewHotelType(), $entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //Setear el average
            $hotel = $entity->getHotel();
            $hotel->setAvgReviews($hotel->getAverageVotes());
            $em->persist($hotel);
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
        $hotel = $em->getRepository('DaiquiriAdminBundle:Hotel')->findOneBy(array('slug' => $slug));
        if ($hotel) {
            $entity = new \Daiquiri\AdminBundle\Entity\ReviewHotel();
            $entity->setHotel($hotel);
            $entity->setVotes(5);
            $form = $this->createForm(new \Daiquiri\SiteBundle\Form\ReviewHotelType(), $entity);
            return $this->render('DaiquiriSiteBundle:Hotel:form_to_new_review_into_hotel.html.twig', array('form' => $form->createView(),
                'review' => $entity));
        }
        return new Response();
    }

}
