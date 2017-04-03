<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use Daiquiri\AdminBundle\Entity\Season;
use Daiquiri\AdminBundle\Entity\Room;
use \Symfony\Component\HttpFoundation\Response;
use Daiquiri\AdminBundle\Entity\Ocupation;
use Daiquiri\ReservationBundle\Form\OcupationSearcherType;
use \Doctrine\Common\Collections\Collection;
use \Daiquiri\ReservationBundle\Entity\OcupationItem;
use \Doctrine\ORM\EntityRepository;
use Daiquiri\AdminBundle\Entity\CircuitSeason;
use Daiquiri\AdminBundle\Entity\CircuitSeasonDate;


/**
 * Hotel controller.
 *
 */
class CircuitController extends SonataCRUDController {

    public function renderResultItemCircuitAction($obj, $searcher) {
        if ($obj) {
            $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\CircuitItemType(), new \Daiquiri\ReservationBundle\Entity\CircuitItem(), array());
            return $this->render('DaiquiriReservationBundle:Circuit:result_item_circuit.html.twig', array(
                        'obj' => $obj,
                        'form_item' => $form_item->createView(),
                        'searcher' => $searcher
            ));
        }
        return new Response();
    }

    public function addToCartAction(Request $request) {
        return $this->forward('DaiquiriReservationBundle:CartItem:addCircuitItem', array('request' => $request));
    }

    public function formCircuitSearcherAction($id) {
        return $this->forward('DaiquiriReservationBundle:CircuitSearcher:getFormIntoCircuitSearcher', array(
                    'id' => $id,
                    '_sonata_admin' => 'admin.circuit.searcher',
                    'view_render' => 'DaiquiriReservationBundle:Circuit:form_searcher_into_circuit.html.twig',
        ));
    }

    public function formCircuitSeasonDatesPriceAction($id = null) {

        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository('DaiquiriAdminBundle:Circuit')->findOneById($id);

        if (!$circuit) {
            $this->addFlash('sonata_flash_error', 'The Circuit with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $circuits_seasons = $circuit->getCircuitSeasons();

        if (count($circuits_seasons) < 0) {
            $this->addFlash('sonata_flash_error', 'The Circuit with id :' . $id . ' not have Circuit Seasons Asociated.');
            return $this->redirect($this->admin->generateUrl('list'));
        }


        $forms = array();
        foreach ($circuits_seasons as $circuit_season) {
            $form = $this->formCreateDatesPriceForCircuitSeason($circuit_season)->createView();
            $forms[] = array('circuit_season' => $circuit_season, 'form' => $form);
        }


        return $this->render('DaiquiriAdminBundle:Circuit:season_prices_date.html.twig', array(
                    'forms' => $forms,
                    'circuit' => $circuit
        ));
    }

    public function createCircuitSeasonDatesPriceAction(Request $request) {
        $id = $request->request->get('circuit_season');
        $circuit_id = $request->request->get('circuit');
        $em = $this->getDoctrine()->getManager();
        $circuit_season = $em->getRepository('DaiquiriAdminBundle:CircuitSeason')->findOneById($id);
        $circuit = $em->getRepository('DaiquiriAdminBundle:Circuit')->findOneById($circuit_id);

        if (!$circuit) {
            $this->addFlash('sonata_flash_error', 'The Circuit with id :' . $circuit_id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        if (!$circuit_season) {
            $this->addFlash('sonata_flash_error', 'The Circuit Season with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }

        $form = $this->formCreateDatesPriceForCircuitSeason($circuit_season);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            if ($data['startdate'] >= $data['enddate']) {
                $this->addFlash('sonata_flash_error', ' The start date must be greater than the end date');
                return $this->redirect($this->admin->generateUrl('form-circuit-season-dates-price', array('id' => $circuit->getId())));
            }

            $all_dates = array();
            $daterange = new \DatePeriod($data['startdate'], new \DateInterval('P1D'), $data['enddate']);

            foreach ($daterange as $date) {
                $all_dates[] = $date;
            }
            $all_dates[] = $data['enddate'];

            $circuit_season->setAdultPrice($data['adultprice']);
            $circuit_season->setKidPrice($data['kidPrice']);

            $circuit_season_date = $em->getRepository('DaiquiriAdminBundle:CircuitSeasonDate')->findBy(array('circuit_season' => $circuit_season));
            foreach ($circuit_season_date as $aux) {
                $circuit_season->removeCircuitSeasonDay($aux);
                $em->persist($circuit_season);
                $em->flush();
            }

            foreach ($all_dates as $dates1) {
                $circuit_season_date = new CircuitSeasonDate();
                $circuit_season_date->setCircuitSeason($circuit_season);
                $circuit_season_date->setDate($dates1);
                $em->persist($circuit_season_date);
                $em->flush();
            }

            $this->addFlash('sonata_flash_success', 'Create dates for circuit season: ' . $circuit_season . ' successfully.');
            return $this->redirect($this->admin->generateUrl('form-circuit-season-dates-price', array('id' => $circuit->getId())));
        }


        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->redirect($this->admin->generateUrl('form-circuit-season-dates-price', array('id' => $circuit_season->getId())));
    }

 

    public function getCircuitSeasonStartDate($circuit_season) {
        $em = $this->getDoctrine()->getManager();
        $c_season = $em->getRepository('DaiquiriAdminBundle:CircuitSeason')->findOneById($circuit_season->getId());
        if (!$c_season) {
            $this->addFlash('sonata_flash_error', 'The Circuit Season with id :' . $circuit_season->getId() . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }

        $circuit_season_days = $c_season->getCircuitSeasonDays();
        if (count($circuit_season_days) > 0) {
            return $circuit_season_days[0]->getDate();
        } else {
            return new \DateTime('now');
        }
    }

    public function getCircuitSeasonEndDate($circuit_season) {
        $em = $this->getDoctrine()->getManager();
        $c_season = $em->getRepository('DaiquiriAdminBundle:CircuitSeason')->findOneById($circuit_season->getId());
        if (!$c_season) {
            $this->addFlash('sonata_flash_error', 'The Circuit Season with id :' . $circuit_season->getId() . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }

        $circuit_season_days = $c_season->getCircuitSeasonDays();
        if (count($circuit_season_days) > 0) {

            return $circuit_season_days[count($circuit_season_days) - 1]->getDate();
        } else {
            return (new \DateTime('now'))->modify('+ 1 days');
        }
    }

    public function getCircuitSeasonPrice($circuit_season) {
        $em = $this->getDoctrine()->getManager();
        $c_season = $em->getRepository('DaiquiriAdminBundle:CircuitSeason')->findOneById($circuit_season->getId());
        if (!$c_season) {
            $this->addFlash('sonata_flash_error', 'The Circuit Season with id :' . $circuit_season->getId() . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }

        $circuit_season_price = $c_season->getAdultPrice();
        if ($circuit_season_price != 0) {
            return $circuit_season_price;
        } else {
            return 0;
        }
    }

    public function getCircuitSeasonKidPrice($circuit_season) {
        $em = $this->getDoctrine()->getManager();
        $c_season = $em->getRepository('DaiquiriAdminBundle:CircuitSeason')->findOneById($circuit_season->getId());
        if (!$c_season) {
            $this->addFlash('sonata_flash_error', 'The Circuit Season with id :' . $circuit_season->getId() . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }

        $circuit_season_kid_price = $c_season->getKidPrice();
        if ($circuit_season_kid_price != 0) {
            return $circuit_season_kid_price;
        } else {
            return 0;
        }
    }

    

    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository('DaiquiriAdminBundle:Circuit')->find($id);

        $object = new \Daiquiri\ReservationBundle\Entity\CircuitRequest();
        $object->setCircuit($circuit);

        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\CircuitRequestType(), $object, array(
            'action' => $this->generateUrl('create-request-for-circuit')
        ));
        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'object' => $circuit
        ));
    }

    public function circuitAvailabilityAction($id) {
        $em = $this->getDoctrine()->getManager();
        $circuit = $em->getRepository('DaiquiriAdminBundle:Circuit')->findOneById($id);
        if (!$circuit) {
            $this->addFlash('error', 'Not Found Circuit with ID' . $id);
            return $this->redirect($this->admin->generateObjectUrl('list', $circuit));
        }

        return $this->render('DaiquiriAdminBundle:Circuit:circuit_availability.html.twig', array(
                    'circuit' => $circuit,
        ));
    }

    public function setCircuitAvailabilityAction($circuit, $date) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        try {
            $em = $this->getDoctrine()->getManager();
            $d = new \DateTime($date);
            $circuit = $em->getRepository('DaiquiriAdminBundle:Circuit')->find($circuit);
        } catch (\Exception $e) {
            return new Response(json_encode(array(
                        'success' => false,
                        'msg' => 'parameter is not valid'
            )));
        }
        $ra = $circuit->isDepartureDate($d);
        if (!$ra) {
            $ra = new \Daiquiri\AdminBundle\Entity\CircuitAvailability();
            $circuit->addCircuitAvailability($ra);
            $ra->setDate($d);
            $em->persist($circuit);
            $em->persist($ra);
            $em->flush();
            return new Response(json_encode(array(
                        'success' => true,
                        'msg' => 'Circuit ' . $circuit . ' is available in ' . $d->format('M j, Y'),
                        'class' => 'available'
            )));
        }
        $ra = $this->getDoctrine()->getEntityManager()->createQuery('SELECT ca FROM DaiquiriAdminBundle:CircuitAvailability ca JOIN ca.circuits c WHERE c.id = :circuit_id AND ca.date = :date')
                        ->setParameter('date', $d->format('Y-m-d'))
                        ->setParameter('circuit_id', $circuit->getId())->getResult();
        if (count($ra) > 0) {
            $em->remove($ra[0]);
            $em->flush();
        }
        return new Response(json_encode(array(
                    'success' => true,
                    'msg' => 'Circuit ' . $circuit . ' is not available in ' . $d->format('M j, Y'),
                    'class' => 'unavailable'
        )));
    }

}
