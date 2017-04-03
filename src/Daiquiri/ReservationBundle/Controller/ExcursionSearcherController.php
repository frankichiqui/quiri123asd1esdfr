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
class ExcursionSearcherController extends SonataCRUDController {

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

    public function applyAllFilters() {
        $this->searchExcursionFilterByDestination();
        
        $this->searchExcursionFilterByPlace();
        $this->searchExcursionFilterByPoloFrom();
        $this->searchExcursionFilterByType();

        $this->searchExcursionFilterByDate();
        $this->searchExcursionFilterDuration();
        $this->searchExcursionFilterAllowPassengers();
        $this->searchExcursionFilterByExcursion();
    }

    public function searchExcursion() {
        if (!$this->searcher->getExcursion()) {
            if ($this->searcher->getExclusive()) {

                $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:ExcursionExclusive')->findBy(array('available' => true, 'payonline' => true), array('priority' => 'ASC'));
            } else {
                $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:ExcursionColective')->findBy(array('available' => true, 'payonline' => true), array('priority' => 'ASC'));
            }
        } else {
            $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Excursion')->findBy(array(
                'available' => true,
                'payonline' => true,
                'id' => $this->searcher->getExcursion()->getId()
                    ), array('priority' => 'ASC'));
        }
        $this->applyAllFilters();
    }

    public function searchExcursionFilterByDestination() {
        if (!$this->searcher->getPolo() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPlace()) {
                if ($a->getPlace()->getPolo()) {
                    if ($a->getPlace()->getPolo()->getId() == $this->searcher->getPolo()->getId()) {
                        $aux->add($a);
                    }
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchExcursionFilterByExcursion() {
        if (!$this->searcher->getExcursion() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {

            if ($a->getId() == $this->searcher->getExcursion()->getId()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchExcursionFilterByPlace() {
        if (!$this->searcher->getPlaces() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->constaninAllPlaces($this->searcher->getPlaces())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchExcursionFilterByPoloFrom() {
        if (!$this->searcher->getPolofrom() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPolofrom()) {
                if ($a->getPolofrom()->getId() == $this->searcher->getPolofrom()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchExcursionFilterByType() {
        if (!$this->searcher->getTypes() || count($this->result) == 0 || count($this->searcher->getTypes()) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->hasTypes($this->searcher->getTypes())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchExcursionFilterByDate() {
        if (!$this->searcher->getDate() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->isDepartureInDate($this->searcher->getDate())) {

                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchExcursionFilterDuration() {
        if (!$this->searcher->getDuration() || $this->searcher->getDuration() == 0 || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getDuration() == $this->searcher->getDuration()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchExcursionFilterAllowPassengers() {
        if (!$this->searcher->getAdults() || !$this->searcher->getKids() || count($this->result) == 0) {
            return $this;
        }

        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->allowPassenger($this->searcher->getAdults(), $this->searcher->getKids())) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function initSearcherAction($page, $view_render = 'DaiquiriReservationBundle:Excursion:full_search_result.html.twig', $other = array()) {

        $request = $this->getRequest();
        $session = $request->getSession();
        $id = $session->get('searcher');
        $em = $this->getDoctrine()->getManager();
        $searcher = $em->getRepository('DaiquiriReservationBundle:ExcursionSearcher')->find($id);
        if (!$searcher) {
            throw $this->createNotFoundException(
                    'No searcher found for id ' . $id
            );
        }

        $this->setSearcher($searcher);

        $this->searchExcursion();

        $salida = array();

        if (count($this->result)) {
            foreach ($this->result as $r) {
                if ($r instanceof \Daiquiri\AdminBundle\Entity\ExcursionColective) {
                    $item = array(
                        'price' => $r->getPriceByAdultAndKidds($this->searcher->getDate(), $this->searcher->getAdults(), $this->searcher->getKids(), $this->get('market')->getObject()),
                        'colective' => true,
                        'obj' => $r,
                        'searcher' => $this->searcher,
                        'form_item' => $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionColectiveItemType(), new \Daiquiri\ReservationBundle\Entity\ExcursionColectiveItem(), array())->createView(),
                    );
                } else {
                    $item = array(
                        'colective' => false,
                        'price' => $r->getPriceByAdultAndKidds($this->searcher->getDate(), $this->searcher->getAdults(), $this->searcher->getKids(), $this->get('market')->getObject()),
                        'obj' => $r,
                        'searcher' => $this->searcher,
                        'form_item' => $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionExclusiveItemType(), new \Daiquiri\ReservationBundle\Entity\ExcursionExclusiveItem(), array())->createView(),
                    );
                }
                $salida[] = $item;
            }
        }
        $count = count($salida);



        if ($count > 0) {

            $this->addFlash('success', $this->searcher . ' <b>' . $count . ' Results </b>');
        } else {

            $this->addFlash('error', $this->searcher . '. Please change your seach param');
        }
        //dump($this->searcher  );die;

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

            return $this->render($view_render, array_merge(array(
                        'searcher' => $this->searcher,
                        'salida' => $pagerfanta,
                        'searcher_date' => $this->searcher->getDate()
                                    ), $other));
        }

        return $this->render($view_render, array_merge(array(
                    'colective' => ($this->searcher->getExcursion() && $this->searcher->getExcursion() instanceof \Daiquiri\AdminBundle\Entity\ExcursionColective) ? true : false,
                    'form' => $this->admin->getForm()->createView(),
                    'action' => 'create',
                    'searcher' => $this->searcher,
                    'salida' => $salida
                                ), $other));
    }

    public function getFullExcursionSearcherAction($data = null) {

        $form = $this->admin->getForm();
        $searcher = $this->searcher;
        if (!$this->searcher) {
            $searcher = new \Daiquiri\ReservationBundle\Entity\ExcursionSearcher();
        }

        return $this->render('DaiquiriReservationBundle:Excursion:full_searcher.html.twig', array(
                    'form' => $form->setData($data)->createView(),
                    'action' => 'create',
                    'object' => $searcher
        ));
    }

    public function getFormIntoExcursionSearcherAction($id, $view_render = 'DaiquiriReservationBundle:Excursion:form_searcher_into_excursion.html.twig', $merge_array = array()) {
        $excursion = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Excursion')->findOneById($id);

        if (!$excursion) {
            $this->addFlash('errors', "No found excursion with id " + $id);
        }
        $form = $this->admin->getForm();
        $this->searcher = new \Daiquiri\ReservationBundle\Entity\ExcursionSearcher();
        $this->searcher->setExcursion($excursion);

        $this->searcher->setExclusive(true);
        if ($this->searcher->getExcursion() instanceof \Daiquiri\AdminBundle\Entity\ExcursionColective) {
            $this->searcher->setExclusive(false);
        }

        return $this->render($view_render, array(
                    'searcher' => $this->searcher,
                    'form' => $form->createView(),
                    'action' => 'create',
        ));
    }

    public function renderResultItemAction($item) {
        return $this->render('DaiquiriReservationBundle:Excursion:result_item_excursion.html.twig', $item);
    }

    public function createAction() {
        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:Excursion:full_search_result.html.twig');
        //dump($view_render);die;    
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


                    if ($object->getExcursion()) {
                        if ($object->getExcursion() instanceof \Daiquiri\AdminBundle\Entity\ExcursionColective) {
                            $object->setExclusive(false);
                        } else {
                            $object->setExclusive(true);
                        }
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
        if (\Daiquiri\AdminBundle\Entity\Validate::isMoreThanMinDate($object->getDate())) {
            return true;
        }
        return false;
    }

}
