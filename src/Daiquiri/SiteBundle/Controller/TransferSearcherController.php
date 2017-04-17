<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Daiquiri\ReservationBundle\Entity\TransferSearcher;
use Daiquiri\SiteBundle\Form\TransferSearcherType;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\ArrayAdapter,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

/**
 * TransferSearcher controller.
 *
 */
class TransferSearcherController extends Controller {

    /**
     * Displays a form to create a new TransferSearcher entity.
     *
     */
    public function newAction() {
        $entity = new TransferSearcher();
        $form = $this->createCreateForm($entity);

        return $this->render('DaiquiriSiteBundle:Transfer:form.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    public function listAction($page) {
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Transfer');
        $query = $repository->createQueryBuilder('t')
                ->where('t.available = TRUE')
                ->orderBy('t.priority', 'ASC')                
                ->getQuery();

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(2);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }


        $vars = $this->getFilterTransfersVars($query);

        return $this->render('DaiquiriSiteBundle:Transfer:list.html.twig', array(                    
                    'salida' => $pagerfanta,
                    'placetos' => $vars['placetos'],
                    'placefrom' => $vars['placefrom'],
                    'date' => $vars['date'],
                    
        ));
    }

    public function getFilterTransfersVars($query) {            

        $vars = array(            
            'placetos' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Transfer')->getTransfersByPlaceTo(),
            'placefrom' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Transfer')->getTransfersByPlaceFrom(),
            'date' =>  (new \DateTime('now'))->modify('+4 days')
              );
        return $vars;
    }

    public function listAjaxFilterAction($page = 1) {
        $pickup = $this->container->get('request_stack')->getCurrentRequest()->get("pickup");
        $dropoff = $this->container->get('request_stack')->getCurrentRequest()->get("dropoff");
        $type  = $this->container->get('request_stack')->getCurrentRequest()->get("type");
        $sort  = $this->container->get('request_stack')->getCurrentRequest()->get("sort");

        $filterVars = array(
            'pickup' => $pickup,
            'dropoff' => $dropoff,
            'type' => $type,
            'sort' => $sort
        );

        $query = $this->resolveTransferFilter($filterVars);

        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(100);

        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }
        
        return $this->render('@DaiquiriSite/Transfer/ajax_transfer.html.twig', array(
            'salida' => $pagerfanta,
            'isAjax' => true,
        ));
    }

    public function resolveTransferFilter($filterVars){
        $repository = $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Transfer');
        $pickup = $filterVars['pickup'];
        $dropoff= $filterVars['dropoff'];
        $type= $filterVars['type'];
        $sort =  $filterVars['sort'];

        $query = $repository->createQueryBuilder('t')
            //->leftJoin('c.polofrom', 'p')
            ->leftJoin('t.placefrom', 'pl')            
            ->where('t.available = TRUE');


        if ($pickup != -1){
            $query->andWhere('pl.title = :pickup')
                ->setParameter("pickup", $pickup);
        }
        if ($dropoff != -1){
            $query->andWhere('pl.title = :dropoff')
                ->setParameter("dropoff", $dropoff);

        }

        if ($sort != -1){
            switch ($sort) {
                case 1:
                    $query->orderBy('t.title', 'ASC');
                    break;
                case 2:
                    $query->orderBy('t.title', 'DESC');
                    break;                
            }
        }

        return $query->getQuery();

    }

    public function listByPoloAction($polo, $page) {
        $em = $this->getDoctrine()->getManager();
        $polo = $em->getRepository('DaiquiriAdminBundle:Polo')->findOneBySlug($polo);
        $salida = array();
        foreach ($polo->getPlaces() as $place) {
            if ($place->getIspickupplaceTransfer()) {
                foreach ($place->getTransfersFrom() as $transfer) {
                    $salida[] = $transfer;
                }
            }
        }

        $adapter = new ArrayAdapter($salida);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        //dump($pagerfanta);die;

               $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Transfer');
        $query = $repository->createQueryBuilder('t')
                ->where('t.available = TRUE')
                ->orderBy('t.priority', 'ASC')                
                ->getQuery();
        $vars = $this->getFilterTransfersVars($query);

        return $this->render('DaiquiriSiteBundle:Transfer:list.html.twig', array(
                    'salida' => $pagerfanta,
                    'place' => $polo,
                    'polo' => true,                    
                    'placetos' => $vars['placetos'],
                    'placefrom' => $vars['placefrom'],
                    'date' => $vars['date'],
        ));
    }

    public function listByPickUpPlaceAction($pickupplace, $page) {
        $em = $this->getDoctrine()->getManager();
        $place = $em->getRepository('DaiquiriAdminBundle:Place')->findOneBySlug($pickupplace);
        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Transfer');
        $query = $repository->createQueryBuilder('t')
                ->where('t.available = TRUE AND t.placefrom = :placefrom')
                ->orderBy('t.priority', 'ASC')
                ->setParameter('placefrom', $place)
                ->getQuery();
        $adapter = new DoctrineORMAdapter($query);
        $pagerfanta = new Pagerfanta($adapter);
        //$pagerfanta->setMaxPerPage(1);
        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        /* dump($pagerfanta);
          dump($place);
          die; */

        return $this->render('DaiquiriSiteBundle:Transfer:list.html.twig', array(
                    'salida' => $pagerfanta,
                    'place' => $place,
                    'polo' => false,
                    'date' => (new \DateTime())->modify('+5 days')
        ));
    }

    public function searchAction(Request $request, $page) {
        $entity = new TransferSearcher();
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
        $request->request->set('_sonata_admin', 'admin.transfer.searcher');
        return $this->forward('DaiquiriReservationBundle:TransferSearcher:initSearcher', array(
                    'page' => $page,
                    'view_render' => 'DaiquiriSiteBundle:Transfer:search_result.html.twig',
        ));
    }

    public function getTransfersSlugAndTitleAction() {
        $em = $this->getDoctrine()->getManager();
        $transfers = $em->getRepository('DaiquiriAdminBundle:Transfer')->findBy(array('available' => true), array('priority' => 'ASC'));
        $list = array();
        foreach ($transfers as $transfer) {
            $list[] = array('slug' => $transfer->getSlug(), 'title' => $transfer->getTitle());
        }
        return $this->render('DaiquiriSiteBundle:Transfer:sub_menu.html.twig', array(
                    'list' => $list
        ));
    }

    public function getTransfersByPoloForMenuAction() {
        $em = $this->getDoctrine()->getManager();
        $polos = $em->getRepository('DaiquiriAdminBundle:Polo')->getAllDiferentWithTransfer();
        return $this->render('DaiquiriSiteBundle:Transfer:sub_menu.html.twig', array(
                    'list' => $polos
        ));
    }

  

    public function showTransferAction($slug) {
        $em = $this->getDoctrine()->getManager();
        $transfer = $em->getRepository('DaiquiriAdminBundle:Transfer')->findOneBySlug($slug);
        return $this->render('DaiquiriSiteBundle:Transfer:show.html.twig', array(
                    'transfer' => $transfer
        ));
    }

    public function renderResultItemTransferAction($admin, $obj, $searcher, $colective = true) {
        if ($admin == 'admin.transfercolective') {
            $admin = $this->get('admin.transfercolective');
        } else {
            $admin = $this->get('admin.transferexclusive');
        }
        if ($colective) {
            if ($obj) {

                if ($searcher->getRoundtrip()) {
                    $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferColectiveItem, array());

                    $form_item_reverse = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveItemType(true), new \Daiquiri\ReservationBundle\Entity\TransferColectiveItem, array());

                    return $this->render('DaiquiriSiteBundle:Transfer:result_item_transfer.html.twig', array(
                                'admin' => $admin,
                                'obj' => $obj,
                                'form_item' => $form_item->createView(),
                                'form_item_reverse' => $form_item_reverse->createView(),
                                'searcher' => $searcher,
                                'colective' => true,
                                'reverse' => $this->getReverseTransfer($obj, 'TransferColective')
                    ));
                }
                $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferColectiveItem(), array());
                return $this->render('DaiquiriSiteBundle:Transfer:result_item_transfer.html.twig', array(
                            'admin' => $admin,
                            'obj' => $obj,
                            'form_item' => $form_item->createView(),
                            'searcher' => $searcher,
                            'colective' => true
                ));
            }
        } else {
            if ($obj) {
                if ($searcher->getRoundtrip()) {
                    $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferExclusiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferExclusiveItem(), array());

                    $form_item_reverse = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferExclusiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferExclusiveItem(), array());

                    return $this->render('DaiquiriSiteBundle:Transfer:result_item_transfer.html.twig', array(
                                'admin' => $admin,
                                'obj' => $obj,
                                'form_item' => $form_item->createView(),
                                'form_item_reverse' => $form_item_reverse->createView(),
                                'searcher' => $searcher,
                                'colective' => false,
                                'reverse' => $this->getReverseTransfer($obj)
                    ));
                }
                $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferExclusiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferExclusiveItem(), array());
                return $this->render('DaiquiriSiteBundle:Transfer:result_item_transfer.html.twig', array(
                            'admin' => $admin,
                            'obj' => $obj,
                            'form_item' => $form_item->createView(),
                            'searcher' => $searcher,
                            'colective' => false
                ));
            }
            return new Response();
        }
        return new Response();
    }

    private function getReverseTransfer($transfer, $tipo = 'TransferExclusive') {
        if (!$transfer->getReverse()) {
            return null;
        }

        $em = $this->getDoctrine()->getManager();
        $reverse = $em->getRepository('DaiquiriAdminBundle:' . $tipo)->findOneBy(array(
            'placefrom' => $transfer->getPlaceto()->getId(),
            'placeto' => $transfer->getPlacefrom()->getId()
        ));

        return $reverse;
    }

    /**
     * Creates a form to create a TransferSearcher entity.
     *
     * @param TransferSearcher $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TransferSearcher $entity) {
        $form = $this->createForm(new TransferSearcherType(), $entity, array(
            //'action' => $this->generateUrl('transfersearcher_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

}
