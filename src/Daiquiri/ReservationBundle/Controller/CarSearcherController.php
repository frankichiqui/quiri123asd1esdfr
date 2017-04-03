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
class CarSearcherController extends SonataCRUDController {

    private $result;
    private $searcher;

    public function getFullCarSearcherAction($data = null) {

        $form = $this->admin->getForm();
        $searcher = $this->searcher;
        if (!$this->searcher) {
            $searcher = new \Daiquiri\ReservationBundle\Entity\CarSearcher();
        }

        return $this->render('DaiquiriReservationBundle:Car:full_searcher.html.twig', array(
                    'form' => $form->setData($data)->createView(),
                    'action' => 'create',
                    'object' => $searcher
        ));
    }

    public function renderItemResultAction($item) {
        return $this->render('DaiquiriReservationBundle:Car:result_item_car.html.twig', $item);
    }

    public function renderResultItemCarAction($obj, $searcher) {
        if ($obj) {
            $form_item = $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\CarItemType(), new \Daiquiri\ReservationBundle\Entity\CarItem(), array());
            return $this->render('DaiquiriReservationBundle:Car:result_item_car.html.twig', array(
                        'obj' => $obj,
                        'form_item' => $form_item->createView(),
                        'searcher' => $searcher
            ));
        }
        return new Response();
    }

    public function searchCar() {
        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Car')->findBy(array('available' => true, 'payonline' => true));

        $this->apllyAllFilters();
    }

    public function apllyAllFilters() {
        $tini = microtime(true);
        $this->searchCarFilterByAvailableDateRange();

        $this->searchCarFilterByCapacity();

        $this->searchCarFilterByCarCategory();

        $this->searchCarFilterByCarClass();

        $this->searchCarFilterByCarLuggageCapacity();

        $this->searchCarFilterByDriver();

        $this->searchCarFilterByCar();
        $endtime = microtime(true);
        $this->searcher->setDuration($endtime - $tini);
        $this->addResultsToSearch();
    }

    public function addResultsToSearch() {
        $result = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $obj = new \Daiquiri\ReservationBundle\Entity\Result();
            $obj->setPickupplace($this->searcher->getPickupplace());
            $obj->setDropoffplace($this->searcher->getDropoffplace());
            $obj->setStartdate($this->searcher->getStartdate());
            $obj->setMarket($this->get('market')->getObject());
            $obj->setObj($r);
            $this->getDoctrine()->getManager()->persist($obj);
            $result->add($obj);
        }
        $this->searcher->setResults($result);
        $this->getDoctrine()->getManager()->persist($this->searcher);
        $this->getDoctrine()->getManager()->flush();
    }

    public function searchCarFilterByCarClass() {

        if (!$this->searcher->getClass() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getCarClass()) {
                if ($a->getCarClass()->getId() == $this->searcher->getClass()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCarFilterByCar() {
        if (!$this->searcher->getCar() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getId() == $this->searcher->getCar()->getId()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCarFilterByCarCategory() {

        if (!$this->searcher->getCategory() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getCarCategory()) {
                if ($a->getCarCategory()->getId() == $this->searcher->getCategory()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCarFilterByCarLuggageCapacity() {

        if (!$this->searcher->getLuggagecapacity() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getLuggagecapacity()) {
                if ($a->getLuggagecapacity()->getId() == $this->searcher->getLuggagecapacity()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCarFilterByCapacity() {

        if (!$this->searcher->getCapacity() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getCapacity()) {
                if ($a->getCapacity()->getId() == $this->searcher->getCapacity()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCarFilterByDriver() {

        if (count($this->result) == 0 || !$this->searcher->getDriver()) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->hasDriver($this->searcher->getDriver())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCarFilterByAvailableDateRange() {

        if (!$this->searcher->getStartdate() || !$this->searcher->getEnddate() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->isAvailableInDateRange($this->searcher->getStartdate(), $this->searcher->getEnddate())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

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

    public function createAction() {
        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:Car:full_search_result.html.twig');


        $request = $this->getRequest();
        //dump($request);die;
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

                    if (!$this->validateObjects($object) || !$object->getPickupplace() || !$object->getDropoffplace()) {

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

        return $this->initSearcherAction(null, $view_render);
    }

    public function validateObjects($object) {
        if (\Daiquiri\AdminBundle\Entity\Validate::startAndEndDate($object->getStartdate(), $object->getEnddate())) {
            return true;
        }
        return false;
    }

    public function initSearcherAction($page, $view_render = 'DaiquiriReservationBundle:Car:full_search_result.html.twig') {

        $request = $this->getRequest();
        $session = $request->getSession();
        $id = $session->get('searcher');
        $em = $this->getDoctrine()->getManager();
        $searcher = $em->getRepository('DaiquiriReservationBundle:CarSearcher')->find($id);
        if (!$searcher) {
            throw $this->createNotFoundException(
                    'No searcher found for id ' . $id
            );
        }

        $this->setSearcher($searcher);
        // dump($this->searcher);die;

        $this->searchCar();

        $salida = array();

        if (count($this->result)) {
            foreach ($this->result as $r) {
                $item = array(
                    'obj' => $r,
                    'searcher' => $this->searcher,
                    'form_item' => $this->createForm(new \Daiquiri\ReservationBundle\Form\CarItemType(), new \Daiquiri\ReservationBundle\Entity\CarItem(), array())->createView(),
                );
                $salida[] = $item;
            }
        }

        $count = count($salida);
        if ($count > 0) {
            $this->addFlash('success', $this->searcher . ' <b>' . $count . ' Results </b>');
        } else {
            $this->addFlash('error', $this->searcher . '. Please change your seach param');
        }



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

            //dump($pagerfanta);die;

            return $this->render($view_render, array(
                        'searcher' => $this->searcher,
                        'salida' => $pagerfanta,
                        'startdate' => $this->searcher->getStartDate(),
                        'enddate' => $this->searcher->getEndDate(),
            ));
        }

        return $this->render($view_render, array(
                    'form' => $this->admin->getForm()->createView(),
                    'action' => 'create',
                    'searcher' => $this->searcher,
                    'startdate' => $this->searcher->getStartDate(),
                    'enddate' => $this->searcher->getEndDate(),
                    'salida' => $salida
        ));
    }

    public function getFormIntoCarSearcherAction($id, $view_render = 'DaiquiriReservationBundle:Car:form_searcher_into_car.html.twig', $merge_array = array()) {
        $car = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Car')->findOneById($id);

        if (!$car) {
            $this->addFlash('errors', "No found car with id " + $id);
        }
        $form = $this->admin->getForm();
        $this->searcher = new \Daiquiri\ReservationBundle\Entity\CarSearcher();
        $this->searcher->setCar($car);
        return $this->render($view_render, array(
                    'searcher' => $this->searcher,
                    'form' => $form->createView(),
                    'action' => 'create',
        ));
    }

}
