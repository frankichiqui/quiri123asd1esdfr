<?php

namespace Daiquiri\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;

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
class RentalHouseRoomSearcherController extends SonataCRUDController {

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

    public function apllyAllFilters() {

        // $this->searchRentalHouseRoomFilterByPrivateRental();
        $this->searchRentalHouseRoomFilterByNumberRooms();

        $this->searchRentalHouseRoomFilterByFacilitiesHouse();
        $this->searchRentalHouseRoomFilterByPolo();
        $this->searchRentalHouseRoomFilterByProvince();
        $this->searchRentalHouseRoomFilterByHouseType();
        $this->searchRentalHouseRoomFilterByRentalHouse();
    }

    public function getFullRentalHouseRoomSearcherAction($data = null) {

        $form = $this->admin->getForm();
        $searcher = $this->searcher;
        if (!$this->searcher) {
            $searcher = new \Daiquiri\ReservationBundle\Entity\RentalHouseRoomSearcher();
        }
        return $this->render('DaiquiriReservationBundle:RentalHouse:full_searcher.html.twig', array(
                    'form' => $form->setData($data)->createView(),
                    'action' => 'create',
                    'object' => $searcher
        ));
    }

    public function renderResultItemAction($item) {
        return $this->render('DaiquiriReservationBundle:RentalHouse:result_item_rentalhouseroom.html.twig', $item);
    }

    public function searchRentalHouseRoom() {

        if ($this->searcher->getHouse() && count(explode("-", $this->searcher->getHouse())) == 2) {
            try {
                $class = explode("-", $this->searcher->getHouse())[0];
                $id = explode("-", $this->searcher->getHouse())[1];
                if ($class === "RentalHouse") {
                    $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:' . $class)->findBy(array('id' => $id));
                    return $this;
                }

                if ($class === "Polo") {
                    $polo = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Polo')->findOneBy(array('id' => $id));
                    if ($polo) {
                        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:RentalHouse')->getRentalHouseByPolo($polo->getId());
                    }
                    return $this;
                }
                if ($class === "Province") {
                    $province = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Province')->findOneBy(array('id' => $id));

                    if ($province) {

                        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:RentalHouse')->getRentalHouseByProvice($province->getId());
                    }
                    return $this;
                }
            } catch (\Exception $e) {

                return $this;
            }
        } else {
            $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:RentalHouse')->findBy(array('available' => true, 'payonline' => true));
        }
        $this->apllyAllFilters();
    }

    public function searchRentalHouseRoomFilterByPrivateRental() {
        if (!$this->searcher->getPrivateRental() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPrivateRental() == $this->searcher->getPrivateRental()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchRentalHouseRoomFilterByFacilitiesHouse() {

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

    public function searchRentalHouseRoomFilterByProvince() {

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

    public function searchRentalHouseRoomFilterByRentalHouse() {

        if (!$this->searcher->getRentalHouse() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getId() == $this->searcher->getRentalHouse()->getId()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchRentalHouseRoomFilterByPolo() {

        if (!$this->searcher->getPolo() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getZone()) {
                if ($a->getZone()->getProvince()) {
                    if ($a->getZone()->getProvince()->hasPolo($this->searcher->getPolo())) {
                        $aux->add($a);
                    }
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchRentalHouseRoomFilterByHouseType() {

        if (!$this->searcher->getPolo() || count($this->result) == 0) {
            return $this;
        }
        //dump($this->searcher);die;
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->hasTypes($this->searcher->getType())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchRentalHouseRoomFilterByNumberRooms() {
        if (!$this->searcher->getRooms() || $this->searcher->getRooms() === 0 || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($this->searcher->getRooms() != 7 && $a->getRooms() == $this->searcher->getRooms()) {
                $aux->add($a);
            }
            if ($this->searcher->getRooms() == 7 && $a->getRooms() >= 7) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    // este debe ser el primero ya que transforma el arreglo de resultados en un array que contiene la forma array('rentalhouse' => $r, 'availableroom' => $av);
    public function searchRentalHouseRoomFilterByDateRange() {

        if (!$this->searcher->getStartdate() || !$this->searcher->getEnddate() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($this->result as $rentalhouse) {

            $av = $rentalhouse->getRoomAvailablesInRangeDate(
                    $this->searcher->getStartdate(), $this->searcher->getEnddate());

            if (count($av) > 0) {
                $item = array('rentalhouse' => $rentalhouse, 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchRentalHouseRoomFilters() {

        $this->searchRentalHouseRoomFilterByDateRange();
        $this->searchRentalHouseRoomFilterByNorReserveYet();
        $this->searchRentalHouseRoomFilterByFacilitiesRooms();
        $this->searchRentalHouseRoomFilterByOcupationRooms();
        $this->searchRentalHouseRoomFilterByRentalHouseRoom();
        // dump($this->result);die;
    }

    public function initSearcherAction($page, $view_render = 'DaiquiriReservationBundle:RentalHouse:full_search_result.html.twig') {

        $request = $this->getRequest();
        $session = $request->getSession();
        $id = $session->get('searcher');
        $em = $this->getDoctrine()->getManager();
        $searcher = $em->getRepository('DaiquiriReservationBundle:RentalHouseRoomSearcher')->find($id);
        if (!$searcher) {
            throw $this->createNotFoundException(
                    'No searcher found for id ' . $id
            );
        }

        $this->setSearcher($searcher);

        $this->searchRentalHouseRoom();

        $this->searchRentalHouseRoomFilters();
        //dump($this->result);die;
        $salida = array();


        if (count($this->result)) {
            foreach ($this->result as $r) {
                $av = array();
                foreach ($r['availableroom'] as $ar) {
                    $av[] = array(
                        'obj' => $ar,
                        'searcher' => $this->searcher,
                        'form_item' => $this->createForm(new \Daiquiri\ReservationBundle\Form\RentalHouseRoomItemType(), new \Daiquiri\ReservationBundle\Entity\RentalHouseRoomItem(), array())->createView(),
                    );
                }

                $item = array('rentalhouse' => $r['rentalhouse'], 'availableroom' => $av);
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

        if ($page != null) {

            $adapter = new ArrayAdapter($salida);
            $pagerfanta = new Pagerfanta($adapter);
            //$pagerfanta->setMaxPerPage(2);
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

            return $this->render($view_render, array(
                        'rooms' => $rooms,
                        'searcher' => $this->searcher,
                        'startdate' => $this->searcher->getStartDate(),
                        'enddate' => $this->searcher->getEndDate(),
                        'salida' => $pagerfanta
            ));
        }

        return $this->render($view_render, array(
                    'form' => $this->admin->getForm()->createView(),
                    'action' => 'create',
                    'searcher' => $this->searcher,
                    'salida' => $this->result
        ));
    }

    public function searchRentalHouseRoomFilterByFacilitiesRooms() {

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
                $item = array('rentalhouse' => $r['rentalhouse'], 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
    }

    public function searchRentalHouseRoomFilterByNorReserveYet() {

        if (count($this->result) == 0) {
            return $this;
        }


        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $av = array();
            foreach ($r['availableroom'] as $room) {

                $reserves = $this->getDoctrine()->getManager()->getRepository('DaiquiriReservationBundle:RentalHouseRoomItem')->findBy(array('room' => $room->getId()));
                if (!$reserves) {
                    $av[] = $room;
                } else {
                    $hay = false;
                    foreach ($reserves as $r) {
                        if (($r->getStartdate() <= $this->searcher->getStartdate() && $r->getEnddate() >= $this->searcher->getStartdate()) || ($r->getStartdate() <= $this->searcher->getEnddate() && $r->getEnddate() >= $this->searcher->getEnddate())) {
                            $hay = true;
                        }
                    }
                    if (!$hay) {
                        $av[] = $room;
                    }
                }
            }

            if (count($av) > 0) {
                $item = array('rentalhouse' => $r['rentalhouse'], 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
    }

    public function searchRentalHouseRoomFilterByOcupationRooms() {
        if (count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $av = array();
            foreach ($r['availableroom'] as $room) {

                if ($room->allowOcupation($this->searcher->getAdults(), $this->searcher->getKids())) {
                    $av[] = $room;
                }
            }

            if (count($av) > 0) {
                $item = array('rentalhouse' => $r['rentalhouse'], 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
    }

    public function searchRentalHouseRoomFilterByRentalHouseRoom() {
        if (count($this->result) == 0 || !$this->searcher->getRentalHouseRoom()) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $av = array();
            foreach ($r['availableroom'] as $room) {
                if ($this->searcher->getRentalHouseRoom()) {
                    if ($room->getId() == $this->searcher->getRentalHouseRoom()->getId()) {
                        $av[] = $room;
                    }
                }
            }

            if (count($av) > 0) {
                $item = array('rentalhouse' => $r['rentalhouse'], 'availableroom' => $av);
                $aux->add($item);
            }
        }
        $this->result = $aux;
    }

    public function createAction() {
        $request = $this->getRequest();
        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:RentalHouse:full_search_result.html.twig');
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



                    $object->setCreateAt(new \DateTime('now'));
                    $object->setUser($this->getUser());
                    $object = $this->admin->create($object);
                    $this->searcher = $object;
//dump($object);
// die;
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

        return $this->initSearcherAction(null, $view_render);
    }

    public function getFormIntoRentalHouseAction($id, $view_render = 'DaiquiriReservationBundle:RentalHouse:form_searcher_into_rental_house.html.twig') {
        $rental = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:RentalHouse')->findOneById($id);
        if ($rental) {
            $searcher = new \Daiquiri\ReservationBundle\Entity\RentalHouseRoomSearcher();
            $searcher->setRentalhouse($rental);
            return $this->render($view_render, array(
                        'rentalhouse' => $rental,
                        'searcher' => $searcher,
                        'form' => $this->admin->getForm()->setData($searcher)->createView()
            ));
        }
    }

}
