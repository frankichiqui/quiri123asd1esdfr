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
class TransferSearcherController extends SonataCRUDController {

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

    public function getFullTransferSearcherAction($data = null) {

        $form = $this->admin->getForm();
        $searcher = $this->searcher;
        if (!$this->searcher) {
            $searcher = new \Daiquiri\ReservationBundle\Entity\TransferSearcher();
        }

        return $this->render('DaiquiriReservationBundle:Transfer:full_searcher.html.twig', array(
                    'form' => $form->setData($data)->createView(),
                    'action' => 'create',
                    'object' => $searcher
        ));
    }

    public function renderResultItemTransferAction($obj, $searcher, $colective = true) {
        if ($colective) {
            if ($obj) {

                if ($searcher->getRoundtrip()) {
                    $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferColectiveItem, array());

                    $form_item_reverse = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveItemType(true), new \Daiquiri\ReservationBundle\Entity\TransferColectiveItem, array());

                    return $this->render('DaiquiriReservationBundle:Transfer:result_item_transfer.html.twig', array(
                                'obj' => $obj,
                                'form_item' => $form_item->createView(),
                                'form_item_reverse' => $form_item_reverse->createView(),
                                'searcher' => $searcher,
                                'colective' => true,
                                'reverse' => $this->getReverseTransfer($obj, 'TransferColective')
                    ));
                }
                $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferColectiveItem(), array());
                return $this->render('DaiquiriReservationBundle:Transfer:result_item_transfer.html.twig', array(
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

                    return $this->render('DaiquiriReservationBundle:Transfer:result_item_transfer.html.twig', array(
                                'obj' => $obj,
                                'form_item' => $form_item->createView(),
                                'form_item_reverse' => $form_item_reverse->createView(),
                                'searcher' => $searcher,
                                'colective' => false,
                                'reverse' => $this->getReverseTransfer($obj)
                    ));
                }
                $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferExclusiveItemType(), new \Daiquiri\ReservationBundle\Entity\TransferExclusiveItem(), array());
                return $this->render('DaiquiriReservationBundle:Transfer:result_item_transfer.html.twig', array(
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


    public function getFilterTransfersVars() {            

        $repository = $this->getDoctrine()
                ->getRepository('DaiquiriAdminBundle:Transfer');
        $query = $repository->createQueryBuilder('t')
                ->where('t.available = TRUE')
                ->orderBy('t.priority', 'ASC')                
                ->getQuery();


        $vars = array(            
            'placetos' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Transfer')->getTransfersByPlaceTo(),
            'placefrom' => $this->getDoctrine()->getRepository('DaiquiriAdminBundle:Transfer')->getTransfersByPlaceFrom(),
            'date' =>  (new \DateTime('now'))->modify('+4 days')
              );
        return $vars;
    }

    public function initSearcherAction($page, $view_render = 'DaiquiriReservationBundle:Transfer:full_search_result.html.twig') {
        $request = $this->getRequest();
        $session = $request->getSession();
        $id = $session->get('searcher');
        $em = $this->getDoctrine()->getManager();
        $searcher = $em->getRepository('DaiquiriReservationBundle:TransferSearcher')->find($id);
        if (!$searcher) {
            throw $this->createNotFoundException(
                    'No searcher found for id ' . $id
            );
        }

        $vars = $this->getFilterTransfersVars();

        $this->setSearcher($searcher);

        $this->searchTransfer();

        $salida = array();

        if (count($this->result)) {
            foreach ($this->result as $r) {
                if ($this->searcher->getRoundtrip()) {

                    $item = array(
                        'obj' => $r,
                        'searcher' => $this->searcher,
                        'colective' => ($r instanceof \Daiquiri\AdminBundle\Entity\TransferColective) ? TRUE : FALSE,
                    );
                } else {
                    $item = array(
                        'obj' => $r,
                        'searcher' => $this->searcher,
                        'colective' => ($r instanceof \Daiquiri\AdminBundle\Entity\TransferColective) ? TRUE : FALSE,
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

        if ($page != null) {
            $adapter = new ArrayAdapter($salida);
            $pagerfanta = new Pagerfanta($adapter);
            //$pagerfanta->setMaxPerPage(3);
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

            return $this->render($view_render, array(
                        'action' => 'create',
                        'searcher' => $this->searcher,
                        'salida' => $pagerfanta,
                        'date' => $this->searcher->getDate(),
                        'dateroundtrip' => $this->searcher->getDateroundtrip(),
                        'roundtrip' => $this->searcher->getRoundtrip(),
                        'placetos' => $vars['placetos'],
                        'placefrom' => $vars['placefrom'],
                        'date' => $vars['date'],
            ));
        }

        return $this->render($view_render, array(
                    'form' => $this->admin->getForm()->createView(),
                    'action' => 'create',
                    'searcher' => $this->searcher,
                    'salida' => $salida,
                    'placetos' => $vars['placetos'],
                    'placefrom' => $vars['placefrom'],
                    'date' => $vars['date'],
        ));
    }

    public function searchTransfer() {
        $this->result = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Transfer')->findBy(array('available' => true, 'payonline' => true));
        $this->apllyAllFilters();
    }

    public function searchTransferFilterByPoloFrom() {

        if (!$this->searcher->getPolofrom() || count($this->result) == 0) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPlaceFrom()->getPolo()) {
                if ($a->getPlaceFrom()->getPolo()->getId() == $this->searcher->getPolofrom()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchTransferFilterByPoloTo() {
        if (!$this->searcher->getPoloto() || count($this->result) == 0) {

            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPlaceTo()->getPolo()) {
                if ($a->getPlaceTo()->getPolo()->getId() == $this->searcher->getPoloto()->getId()) {
                    $aux->add($a);
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchTransferFilterByTransfer() {
        if (!$this->searcher->getTransfer() || count($this->result) == 0) {

            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getId() == $this->searcher->getTransfer()->getId()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchTransferFilterByPlaceTo() {
        if (!$this->searcher->getPlaceto() || count($this->result) == 0) {

            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPlaceTo()->getId() == $this->searcher->getPlaceto()->getId()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchTransferFilterByPlaceFrom() {
        if (!$this->searcher->getPlacefrom() || count($this->result) == 0) {

            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($a->getPlaceFrom()->getId() == $this->searcher->getPlacefrom()->getId()) {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchTransferFilterByExclusive() {
        if (count($this->result) == 0 || $this->searcher->getExclusive() == -1) {
            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($this->searcher->getExclusive() > 0) {
                if ($a instanceof \Daiquiri\AdminBundle\Entity\TransferExclusive) {
                    $aux->add($a);
                } else {
                    // $aux->add(array('obj' => $a, 'resume' => 0));
                }
            } else {
                if ($a instanceof \Daiquiri\AdminBundle\Entity\TransferColective) {
                    $aux->add($a);
                } else {
                    // $aux->add(array('obj' => $a, 'resume' => 0));
                }
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function searchTransferFilterByRoundTrip() {
        if (count($this->result) == 0) {

            return $this;
        }
        $aux = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $a) {
            if ($this->searcher->getRoundtrip()) {
                if (!$a->getReverse()) {
                    // $aux->add(array('obj' => $a, 'resume' => 0));
                } else {
                    $aux->add($a);
                }
            } else {
                $aux->add($a);
            }
        }
        $this->result = $aux;
        return $this;
    }

    public function addResultsToSearch() {
        $result = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->result as $r) {
            $obj = new \Daiquiri\ReservationBundle\Entity\Result();
            $obj->setPassengers($this->searcher->getPassengers());
            $obj->setEnddate($this->searcher->getDateroundtrip());
            $obj->setStartdate($this->searcher->getDate());
            $obj->setMarket($this->get('market')->getObject());
            $obj->setProduct('TRANSFER ' . $r);
            $obj->setCreateAt(new \DateTime('now'));
            $obj->setObj($r);
            $this->getDoctrine()->getManager()->persist($obj);
            $result->add($obj);
        }
        $this->searcher->setResults($result);
        $this->getDoctrine()->getManager()->persist($this->searcher);
        $this->getDoctrine()->getManager()->flush();
    }

    public function apllyAllFilters() {
        $tini = microtime(true);
        $this->searchTransferFilterByExclusive();
        $this->searchTransferFilterByPlaceFrom();
        $this->searchTransferFilterByPlaceTo();
        $this->searchTransferFilterByPoloFrom();
        $this->searchTransferFilterByPoloTo();
        $this->searchTransferFilterByRoundTrip();
        $this->searchTransferFilterByTransfer();
        $tfin = microtime(true);
        $this->searcher->setDuration($tfin - $tini);
        $this->getDoctrine()->getManager()->persist($this->searcher);
        $this->getDoctrine()->getManager()->flush();
        $this->addResultsToSearch();
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

    public function createAction($return_result = false) {
        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:Transfer:full_search_result.html.twig');

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
        if ($object->getRoundtrip()) {
            if (!\Daiquiri\AdminBundle\Entity\Validate::startAndEndDate($object->getDate(), $object->getDateroundtrip())) {
                return false;
            }
            return true;
        } else {
            if (!\Daiquiri\AdminBundle\Entity\Validate::isMoreThanMinDate($object->getDate())) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function getFormIntoTransferSearcherAction($id, $view_render = 'DaiquiriReservationBundle:Transfer:form_searcher_into_transfer.html.twig', $merge_array = array()) {
        $transfer = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Transfer')->findOneById($id);

        if (!$transfer) {
            $this->addFlash('errors', "No found transfer with id " + $id);
        }
        $form = $this->admin->getForm();
        $this->searcher = new \Daiquiri\ReservationBundle\Entity\TransferSearcher();
        $this->searcher->setTransfer($transfer);
        $coletive = false;
        if ($this->searcher->getTransfer() instanceof \Daiquiri\AdminBundle\Entity\TransferColective) {
            $coletive = true;
        }
        return $this->render($view_render, array(
                    'searcher' => $this->searcher,
                    'colective' => $coletive,
                    'form' => $form->createView(),
        ));
    }

}
