<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Daiquiri\ReservationBundle\Entity\RentalHouseRoomSearcher;
use Daiquiri\SiteBundle\Form\RentalHouseRoomSearcherType;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

/**
 * RentalHouseRoomSearcher controller.
 *
 */
class RentalHouseRoomSearcherController extends Controller {

    /**
     * Displays a form to create a new RentalHouseRoomSearcher entity.
     *
     */
    public function newAction() {
        $entity = new RentalHouseRoomSearcher();
        $form = $this->createCreateForm($entity);

        return $this->render('DaiquiriSiteBundle:RentalHouse:form.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    public function listAction($page) {
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:RentalHouse');
        $query = $repository->createQueryBuilder('r')
                ->where('r.available = TRUE')
                ->orderBy('r.priority', 'ASC')
                ->getQuery();

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }


        return $this->render('DaiquiriSiteBundle:RentalHouse:list.html.twig', array(
                    'salida' => $pagerfanta
        ));
    }

    //arreglar buscar como hacer sub consulta dql
    public function listByProvinceAction($province, $page) {
        $em = $this->getDoctrine()->getManager();
        $province = $em->getRepository('DaiquiriAdminBundle:Zone')->findOneBySlug($province);
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:RentalHouse');
        $query = $repository->createQueryBuilder('r')
                ->where('r.available = TRUE AND r.zone = :province')
                ->orderBy('r.priority', 'ASC')
                ->setParameter('province', $province)
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

        return $this->render('DaiquiriSiteBundle:RentalHouse:list.html.twig', array(
                    'salida' => $pagerfanta,
                    'province' => $province
        ));
    }

    public function searchAction(Request $request, $page) {
        $entity = new RentalHouseRoomSearcher();
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
        $request->request->set('_sonata_admin', 'admin.rentalhouseroom.searcher');
        return $this->forward('DaiquiriReservationBundle:RentalHouseRoomSearcher:initSearcher', array(
                    'page' => $page,
                    'view_render' => 'DaiquiriSiteBundle:RentalHouse:search_result.html.twig',
        ));
    }

    public function getRentalHouseByProvinceForMenuAction() {
        $em = $this->getDoctrine()->getManager();
        $provinces = $em->getRepository('DaiquiriAdminBundle:Province')->findBy(array(), array('priority' => 'ASC'));

        $list = array();
        foreach ($provinces as $province) {
            if (count($province->getZones()) > 0) {
                foreach ($province->getZones() as $zone) {
                    if (count($zone->getRentalHouses()) > 0) {
                        foreach ($zone->getRentalHouses() as $house) {
                            if ($house->getAvailable())
                            //cambiar zone por province, depende del listByProvince
                                $list[] = $zone;
                        }
                    }
                }
            }
        }
        $list = array_unique($list);

        return $this->render('DaiquiriSiteBundle:RentalHouse:sub_menu.html.twig', array(
                    'list' => $list
        ));
    }

    public function renderResultItemRentalAction($item) {
        $admin = $this->get('admin.rentalhouse');
        $item['admin'] = $admin;
        return $this->render('DaiquiriSiteBundle:RentalHouse:result_item_rentalhouseroom.html.twig', $item);
    }

    /**
     * Creates a form to create a RentalHouseRoomSearcher entity.
     *
     * @param RentalHouseRoomSearcher $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(RentalHouseRoomSearcher $entity) {
        $form = $this->createForm(new RentalHouseRoomSearcherType(), $entity, array(
            //'action' => $this->generateUrl('rentalhouseroomsearcher_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

}
