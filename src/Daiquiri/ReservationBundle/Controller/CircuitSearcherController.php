<?php

namespace Daiquiri\ReservationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;
use Daiquiri\AdminBundle\Entity\Circuit;
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
class CircuitSearcherController extends SonataCRUDController {

    private $result;
    private $searcher;

    public function getResult() {
        return $this->result;
    }

    public function getSearcher() {
        return $this->searcher;
    }

    public function setResult($result) {
        $this->result = $result;
    }

    public function setSearcher($searcher) {
        $this->searcher = $searcher;
    }

    public function apllyAllFilters() {
        $tini = microtime(true);
        $this->searchCircuitFilterByTitle();
        $this->searchCircuitFilterByDepartureDate();
        $this->searchCircuitFilterByPlaces();
        $this->searchCircuitFilterByNights();
        $this->searchCircuitFilterByDays();
        $this->searchCircuitFilterByPolosfrom();
        $this->searchCircuitFilterByAllowKid();
        $tfin = microtime(true);
        $this->searcher->setDuration($tfin - $tini);
        $this->getDoctrine()->getManager()->persist($this->searcher);
        $this->getDoctrine()->getManager()->flush();
        $this->addResultsToSearch();
    }

    public function addResultsToSearch() {
        $result = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($this->result as $r) {

            $obj = new \Daiquiri\ReservationBundle\Entity\Result();
            $obj->setAdults($this->searcher->getAdults());
            $obj->setKids($this->searcher->getKids());
            $obj->setStartdate($this->searcher->getDate());
            $obj->setMarket($this->get('market')->getObject());
            $obj->setProduct('CIRCUIT ' . $r);
            $obj->setCreateAt(new \DateTime('now'));
            $obj->setObj($r);
            $this->getDoctrine()->getManager()->persist($obj);
            $result->add($obj);
        }
        $this->searcher->setResults($result);
        $this->getDoctrine()->getManager()->persist($this->searcher);
        $this->getDoctrine()->getManager()->flush();
    }

    public function searchCircuitFilterByAllowKid() {
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if (!(!$a->getAllowkid() && $this->searcher->getkids() != 0)) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCircuitFilterByDepartureDate() {

        if (!$this->searcher->getDate() || count($this->result) == 0 || $this->searcher->getBetweendates()) {
            return $this;
        }


        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->isDepartureDate($this->searcher->getDate())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCircuitFilterByTitle() {
        if (!$this->searcher->getTitle() || count($this->result) == 0) {
            return $this;
        }
        if (count(explode("-", $this->searcher->getTitle())) === !2) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        try {
            $class = explode("-", $this->searcher->getTitle())[0];
            $id = explode("-", $this->searcher->getTitle())[1];
        } catch (\Exception $e) {
            return $this;
        }
        $obj = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:' . $class)->find($id);
        if ($obj) {
            $aux->add($obj);
        } else {
            return $this;
        };
        $this->result = $aux;
        return $this;
    }

    public function searchCircuitFilterByNights() {

        if (!$this->searcher->getNights() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getNights() == $this->searcher->getNights()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCircuitFilterByDays() {

        if (!$this->searcher->getDays() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getDays() == $this->searcher->getDays()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCircuitFilterByPlaces() {
        if (!$this->searcher->getPlaces()) {
            return $this;
        }
        if ($this->searcher->getPlaces()->count() == 0 || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->constainPlaces($this->searcher->getPlaces())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCircuitFilterByPolosfrom() {

        if (!$this->searcher->getPolofrom()) {
            return $this;
        }
        if (count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->constainPolofrom($this->searcher->getPolofrom())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchCircuit() {

        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Circuit')->findBy(array('available' => true, 'payonline' => true), array('priority' => 'ASC'));

        $this->apllyAllFilters();
    }

      public function getFilterCircuitVars() {

        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Circuit');
                $query = $repository->createQueryBuilder('c')
                ->where('c.available = TRUE')
                ->orderBy('c.priority', 'ASC')
                ->getQuery();

        $allCircuits = $query->getResult();

         $stars = array(
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        );

        foreach ($allCircuits as $key => $circuit) {
            $starAvg = $circuit->getAverageVotes();
            $starAvg = (int)$starAvg;
            $stars[$starAvg] = $stars[$starAvg] + 1; 
             }

        $vars = array(
            'stars' => $stars,
            'cantAllowKids' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Circuit')->getCountAllowedKids(),
            'NotAllowKids' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Circuit')->getNotAllowedKids(),
            'polos' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Polo')->getPolos(),            
              );

        return $vars;
    }


    public function initSearcherAction($page, $view_render = 'DaiquiriReservationBundle:Circuit:full_search_result.html.twig', $other = array()) {

        $request = $this->getRequest();
        $session = $request->getSession();
        $id = $session->get('searcher');
        $em = $this->getDoctrine()->getManager();
        $searcher = $em->getRepository('DaiquiriReservationBundle:CircuitSearcher')->find($id);
        if (!$searcher) {
            throw $this->createNotFoundException(
                    'No searcher found for id ' . $id
            );
        }

        $this->setSearcher($searcher);

        $this->searchCircuit();

        $salida = array();

        $vars = $this->getFilterCircuitVars();

        if (count($this->result)) {
            foreach ($this->result as $r) {

                $item = array(
                    'obj' => $r,
                    'searcher' => $this->searcher,
                    'form_item' => $this->createForm(new \Daiquiri\ReservationBundle\Form\CircuitItemType(), new \Daiquiri\ReservationBundle\Entity\CircuitItem(), array())->createView(),
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

            return $this->render($view_render, array_merge(array(
                        'searcher' => $this->searcher,
                        'salida' => $pagerfanta,
                        'stars' => $vars['stars'],
                        'cantAllowKids' => $vars['cantAllowKids'],
                        'NotAllowKids' => $vars['NotAllowKids'],
                        'polos' => $vars['polos'],  
                        'searcher_date' => $this->searcher->getDate(),
                        'pickupdays' => $this->getAllPickUpDaysCircuits()
                                    ), $other));
        }
        return $this->render($view_render, array_merge(array(
                    'form' => $this->admin->getForm()->createView(),
                    'action' => 'create',
                    'searcher' => $this->searcher,
                    'stars' => $vars['stars'],
                    'cantAllowKids' => $vars['cantAllowKids'],
                    'NotAllowKids' => $vars['NotAllowKids'],
                    'polos' => $vars['polos'],  
                    'salida' => $salida
                                ), $other));
    }

    public function getFullCircuitSearcherAction($data = null) {

        $form = $this->admin->getForm();
        $searcher = $this->searcher;
        if (!$this->searcher) {
            $searcher = new \Daiquiri\ReservationBundle\Entity\CircuitSearcher();
        }

        return $this->render('DaiquiriReservationBundle:Circuit:full_searcher.html.twig', array(
                    'form' => $form->setData($data)->createView(),
                    'action' => 'create',
                    'object' => $searcher
        ));
    }

    public function renderResultItemAction($item) {
        return $this->render('DaiquiriReservationBundle:Circuit:result_item_circuit.html.twig', $item);
    }

    public function createAction($return_result = false) {
        $request = $this->getRequest();

        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:Circuit:full_search_result.html.twig');


        //dump($view_render);die;
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


        //dump($form);die;

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
                    //dump($this->searcher);die;
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

    public function validateObjects($object) {
        if (\Daiquiri\AdminBundle\Entity\Validate::isMoreThanMinDate($object->getDate())) {
            return true;
        }
        return false;
    }

    public function getFormIntoCircuitSearcherAction($id, $view_render = 'DaiquiriReservationBundle:Circuit:form_searcher_into_circuit.html.twig', $merge_array = array()) {
        $circuit = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Circuit')->findOneById($id);

        if (!$circuit) {
            $this->addFlash('errors', "No found circuit with id " + $id);
        }
        $form = $this->admin->getForm();
        $this->searcher = new \Daiquiri\ReservationBundle\Entity\CircuitSearcher();
        $this->searcher->setCircuit($circuit);
        return $this->render($view_render, array(
                    'searcher' => $this->searcher,
                    'form' => $form->createView(),
                    'action' => 'create',
        ));
    }

    //para obtener los dias en que salen los circuitos
    public function getAllPickUpDaysCircuits() {
        $em = $this->getDoctrine()->getManager();
        $circuits = $em->getRepository('DaiquiriAdminBundle:Circuit')->findAll();

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

}
