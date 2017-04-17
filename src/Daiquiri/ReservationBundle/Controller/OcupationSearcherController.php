<?php

namespace Daiquiri\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;
use DateTime;
//para el paginado
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\ArrayAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException;
use ReflectionObject;

/**
 * Car controller.
 *
 */
class OcupationSearcherController extends SonataCRUDController {

    private $result;
    private $searcher;

    function getResult() {
        return $this->result;
    }

    function getSearcher() {
        return $this->searcher;
    }

    function setResult($result) {
        $this->result = $result;
    }

    function setSearcher($searcher) {
        $this->searcher = $searcher;
    }

    public function searchHotelFilterByUbication() {
        if ($this->searcher->getUbication() && count(explode("-", $this->searcher->getUbication())) == 2) {
            try {
                $class = explode("-", $this->searcher->getUbication())[0];
                $id = explode("-", $this->searcher->getUbication())[1];
                if ($class === "Hotel") {
                    $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:' . $class)->findBy(array('id' => $id));
                    return $this;
                }
                if ($class === "Province") {
                    $province = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Province')->findOneBy(array('id' => $id));

                    if ($province) {
                        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->getHotelsByProvice($province->getId());
                    }
                    return $this;
                }
                if ($class === "Polo") {
                    $polo = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Polo')->findOneBy(array('id' => $id));

                    if ($polo) {
                        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->getHotelsByPolo($polo->getId());
                    }
                    return $this;
                }
            } catch (\Exception $e) {

                return $this;
            }
        } else {
            $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->findAll();
        }
    }

    public function searchHotel() {
        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->findBy(array('available' => true, 'payonline' => true));

        $this->searchHotelFilterByUbication();


        $this->searchHotelFilterByHotel();

        $this->searchHotelFilterByProvince();

        $this->searchHotelFilterByPolo();

        $this->searchHotelFilterByChain();

        $this->searchHotelFilterByHotelFacilities();

        $this->searchHotelFilterByAllowInfant();
    }

    public function addResultsToSearch() {
        $result = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($this->result as $r) {
            foreach ($r['availableroom'] as $av) {
                $obj = new \Daiquiri\ReservationBundle\Entity\Result();
                $obj->setAdults($this->searcher->getAdults());
                $obj->setKids($this->searcher->getKids());
                $obj->setInfants($this->searcher->getInfants());
                $obj->setStartdate($this->searcher->getStartdate());
                $obj->setEnddate($this->searcher->getEnddate());
                $obj->setMarket($this->get('market')->getObject());
                $obj->setProduct('HOTEL ' . $r);
                $obj->setCreateAt(new \DateTime('now'));
                $obj->setObj($av->getOcupation($this->searcher->getAdults(), $this->searcher->getKids()));
                $this->getDoctrine()->getManager()->persist($obj);
                $result->add($obj);
            }
        }
        $this->searcher->setResults($result);
        $this->getDoctrine()->getManager()->persist($this->searcher);
        $this->getDoctrine()->getManager()->flush();
    }

    public function searchHotelFilterByProvince() {
        if (!$this->searcher->getProvince() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getZone()) {
                if ($a->getZone()->getProvince()) {
                    if ($a->getZone()->getProvince()->getId() == $this->searcher->getProvince()->getId()) {
                        $aux->add($a);
                    }
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchHotelFilterByChain() {
        if (!$this->searcher->getChain() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {

            if ($a->getChain()) {
                if ($a->getChain()->getId() == $this->searcher->getChain()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchHotelFilterByHotel() {
        //dump($this->getRequest());
        //dump($this);

        if (!$this->searcher->getHotel() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {

            if ($a->getId() == $this->searcher->getHotel()->getId()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchHotelFilterByPolo() {
        if (!$this->searcher->getPolo() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPolo()) {
                if ($a->getPolo()->getId() == $this->searcher->getPolo()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchHotelFilterByAllowInfant() {
        if (!$this->searcher->getInfants() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getAllowInfant() || (!$a->getAllowInfant() && $this->searcher->getInfants() == 0)) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchHotelFilterByHotelFacilities() {
        if (!$this->searcher->getFacilities() || count($this->searcher->getFacilities()) == 0 || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->hasFacilitiesType($this->searcher->getFacilities())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    // este debe ser el primero ya que transforma el arreglo de resultados en un array que contiene la forma array('rentalhouse' => $r, 'availableroom' => $av);
    public function searchHotelRoomFilterByDateRange() {

        if (!$this->searcher->getStartdate() || !$this->searcher->getEnddate() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($this->result as $hotel) {

            $av = $hotel->getAllRoomAvailableInDates(
                    $this->searcher->getStartdate(), $this->searcher->getEnddate());

            if (count($av) > 0) {
                $item = array('hotel' => $hotel, 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchHotelRoomFilterByOcupation() {
        if (count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $av = array();
            foreach ($r['availableroom'] as $room) {

                if ($room->hasOcupation($this->searcher->getAdults(), $this->searcher->getKids())) {
                    $av[] = $room;
                }
            }

            if (count($av) > 0) {
                $item = array('hotel' => $r['hotel'], 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
    }

    public function searchHotelRoomFilterByRoom() {
        if (count($this->result) == 0 || !$this->searcher->getRoom()) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $av = array();
            foreach ($r['availableroom'] as $room) {

                if ($room->getId() == $this->searcher->getRoom()->getId()) {
                    $av[] = $room;
                }
            }

            if (count($av) > 0) {
                $item = array('hotel' => $r['hotel'], 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
    }

    public function searchHotelRoomFilterByFacilitiesRooms() {

        if (count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $av = array();
            foreach ($r['availableroom'] as $room) {

                if ($room->hasFacilitys($this->searcher->getFacilitiesRoom())) {
                    $av[] = $room;
                }
            }

            if (count($av) > 0) {
                $item = array('hotel' => $r['hotel'], 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
    }

    public function searchHotelRoomFilters() {
        // dump($this->result);
        $this->searchHotelRoomFilterByDateRange();
        //dump($this->result);
        $this->searchHotelRoomFilterByOcupation();
        //  dump($this->result);
        $this->searchHotelRoomFilterByFacilitiesRooms();
        //  dump($this->result);
        $this->searchHotelRoomFilterByRoom();
        //  dump($this->result);
    }


    public function getFilterViewVars(){

        $repository = $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Hotel');
        $query = $repository->createQueryBuilder('h')
            ->where('h.available = TRUE')
            ->orderBy('h.priority', 'ASC');

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

    public function initSearcherAction(Request $request, $page, $view_render = 'DaiquiriReservationBundle:Hotel:full_search_result.html.twig',  $other = array()) {

        $session = $request->getSession();
        $id = $session->get('searcher');
        $em = $this->getDoctrine()->getManager();
        $searcher = $em->getRepository('DaiquiriReservationBundle:OcupationSearcher')->find($id);
        if (!$searcher) {
            throw $this->createNotFoundException(
                    'No searcher found for id ' . $id
            );
        }

        $this->setSearcher($searcher);
        $tini = microtime(true);
        $this->searchHotel();
        $this->searchHotelRoomFilters();
        $tfin = microtime(true);
        $this->searcher->setDuration($tfin - $tini);
        $this->getDoctrine()->getManager()->persist($this->searcher);
        $this->getDoctrine()->getManager()->flush();
        $this->addResultsToSearch();

        $salida = array();


        if (count($this->result)) {
            foreach ($this->result as $r) {
                $av = array();
                foreach ($r['availableroom'] as $ar) {
                    $av[] = array(
                        'price' => $ar->getOcupation($this->searcher->getAdults(), $this->searcher->getKids())->getPriceByDateRange($this->
                                searcher->getStartdate(), $this->searcher->getEnddate(), $this->get('market')->getObject()),
                        'obj' => $ar,
                        'ocupation' => $ar->getOcupation($this->searcher->getAdults(), $this->searcher->getKids()),
                        'infants' => $this->searcher->getInfants(),
                        'suplement' => $ar->getHotel()->getAllSuplementByDateRange($this->
                                searcher->getStartdate(), $this->searcher->getEnddate()),
                        'plans' => $ar->getHotel()->getArrayAvailablePlan(),
                        'searcher' => $this->searcher,
                        'form_item' => $this->createForm(new \Daiquiri\ReservationBundle\Form\OcupationItemType()
                                , new \Daiquiri\ReservationBundle\Entity\OcupationItem(), array('plan' => $ar->getHotel()->getSimpleArrayAvailablePlan()))->createView(),
                    );
                }

                $item = array('hotel' => $r['hotel'], 'availableroom' => $av);
                $salida[] = $item;
            }
        }

        $count = count($salida);
        if ($count > 0) {
            $this->addFlash('success', $this->searcher);
        } else {
            $this->addFlash('error', $this->searcher . '. Please change your seach param');
        }
        $this->result = $salida;


        $filterViewVars = $this->getFilterViewVars();


        if ($page != null) {

            $adapter = new ArrayAdapter($salida);
            $pagerfanta = new Pagerfanta($adapter);
            //$pagerfanta->setMaxPerPage(1);
            try {
                $pagerfanta->setCurrentPage($page);
            } catch (NotValidCurrentPageException $e) {
                throw new NotFoundHttpException();
            }
            /* $pagerfanta->getNbResults();
              $pagerfanta->getMaxPerPage();
              $pagerfanta->getNbPages();
              $pagerfanta->haveToPaginate();
              $pagerfanta->hasPreviousPage();
              $pagerfanta->getPreviousPage();
              $pagerfanta->hasNextPage();
              $pagerfanta->getNextPage();
              $pagerfanta->getCurrentPageResults(); */

            $rooms = 0;


            foreach ($pagerfanta as $p) {
                $rooms += count($p['availableroom']);
            }
            $array = array_merge(array(
                'rooms' => $rooms,
                'startdate' => $this->searcher->getStartDate(),
                'enddate' => $this->searcher->getEndDate(),
                'searcher' => $this->searcher,
                'salida' => $pagerfanta,
                'stars' => $filterViewVars['stars'],
                'hotelFacilities' => $filterViewVars['hotelFacilities'],
                'hotelTypes' => $filterViewVars['hotelTypes'],                 
                    ), $other);

            return $this->render($view_render, $array);
        }

        return $this->render($view_render, array_merge(array(
                    'form' => $this->admin->getForm()->createView(),
                    'stars' => $filterViewVars['stars'],
                    'hotelFacilities' => $filterViewVars['hotelFacilities'],
                    'hotelTypes' => $filterViewVars['hotelTypes'],              
                    'action' => 'create',
                    'searcher' => $this->searcher,
                    'salida' => $this->result
                                ), $other));
    }

    public function renderResultItemAction($item) {
        return $this->render('DaiquiriReservationBundle:Hotel:result_item_ocupation.html.twig', $item);
    }

    public function createAction() {

        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:Hotel:full_search_result.html.twig');
        $request = $this->getRequest();

// the key used to lookup the template
        $templateKey = 'edit';
        $this->admin->checkAccess('create');
        $class = new \ReflectionClass($this->admin->hasActiveSubClass() ? $this->admin->getActiveSubClass() : $this->admin->getClass());

        if ($class->isAbstract()) {
            return $this->render(
                            'SonataAdminBundle:CRUD:select_subclass.html.twig', array(
                        'base_template' => $this->getBaseTemplate(),
                        'admin' => $this->admin,
                        'action' => 'create',
                            ), null, $request
            );
        }

        $object = $this->admin->getNewInstance();

        $preResponse = $this->preCreate($request, $object);
        if ($preResponse !== null) {
            return $preResponse;
        }



        $this->admin->setSubject($object);
        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        $form->handleRequest($request);



        if ($form->isSubmitted()) {
//TODO: remove this check for 4.0
            if (method_exists($this->admin, 'preValidate')) {
                $this->admin->preValidate($object);
            }
            $isFormValid = $form->isValid();

// persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode($request) || $this->isPreviewApproved($request))) {
                $this->admin->checkAccess('create', $object);

                try {
                    $object->setUser($this->getUser());
                    if (!$this->validateObjects($object)) {
                        $this->addFlash("error", "Enter valid dates param to search...");
                        return $this->render($view_render, array(
                                    'form' => $this->admin->getForm()->createView(),
                                    'action' => 'create',
                                    'searcher' => $object,
                        ));
                    }
                    $object = $this->admin->create($object);
                    $this->searcher = $object;
                } catch (ModelManagerException $e) {
                    $this->handleModelManagerException($e);

                    $isFormValid = false;
                }
            }

// show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash(
                            'sonata_flash_error', $this->admin->trans(
                                    'flash_create_error', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );
                }
            } elseif ($this->isPreviewRequested()) {
// pick the preview template if the form was valid and preview was requested
                $templateKey = 'preview';
                $this->admin->getShow();
            }
        }

        $view = $form->createView();

// set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());


        $session = $request->getSession();
        $session->set('searcher', $object->getId());

        return $this->initSearcherAction($request, null, $view_render);
    }

    public function validateObjects($object) {
        if (\Daiquiri\AdminBundle\Entity\Validate::startAndEndDate($object->getStartdate(), $object->getEnddate())) {
            return true;
        }
        return false;
    }

    public function getFullOcupationSearcherAction($data = null) {

        $form = $this->admin->getForm();
        $searcher = $this->searcher;


        if (!$this->searcher) {
            $searcher = new \Daiquiri\ReservationBundle\Entity\OcupationSearcher();
        }
        return $this->render('DaiquiriReservationBundle:Hotel:full_searcher.html.twig', array(
                    'form' => $form->setData($data)->createView(),
                    'action' => 'create',
                    'object' => $searcher
        ));
    }

    public function getFormIntoHotelSearcherAction($id, $view_render = 'DaiquiriReservationBundle:Hotel:form_searcher_into_hotel.html.twig', $merge_array = array()) {
        $hotel = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->findOneById($id);

        if (!$hotel) {
            $this->addFlash('errors', "No found hotel with id " + $id);
        }
        $form = $this->admin->getForm();
        $this->searcher = new \Daiquiri\ReservationBundle\Entity\OcupationSearcher();
        $this->searcher->setHotel($hotel);

        return $this->render($view_render, array(
                    'searcher' => $this->searcher,
                    'form' => $form->createView(),
                    'action' => 'create',
        ));
    }

}
