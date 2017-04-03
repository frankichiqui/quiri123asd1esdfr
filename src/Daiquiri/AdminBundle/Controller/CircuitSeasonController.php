<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;
use Daiquiri\AdminBundle\Entity\CircuitSeason;
use Daiquiri\AdminBundle\Entity\CircuitSeasonDate;

/**
 * Hotel controller.
 *
 */
class CircuitSeasonController extends SonataCRUDController {

    public function formCircuitSeasonDateAction($id) {
        $em = $this->getDoctrine()->getManager();
        $circuit_season = $em->getRepository('DaiquiriAdminBundle:CircuitSeason')->findOneById($id);

        if (!$circuit_season) {
            $this->addFlash('sonata_flash_error', 'The Circuit Season with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $form = $this->formCreateDatesForCircuitSeason($circuit_season);
        return $this->render('DaiquiriAdminBundle:CircuitSeason:date.html.twig', array(
                    'form' => $form->createView(),
                    'circuit_season' => $circuit_season
        ));
    }

    public function createCircuitSeasonDateForCircuitAction(Request $request) {
        $id = $request->request->get('circuit_season');
        $em = $this->getDoctrine()->getManager();
        $circuit_season = $em->getRepository('DaiquiriAdminBundle:CircuitSeason')->findOneById($id);

        if (!$circuit_season) {
            $this->addFlash('sonata_flash_error', 'The Circuit Season with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $form = $this->formCreateDatesForCircuitSeason($circuit_season);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            if ($data['startdate'] >= $data['enddate']) {
                $this->addFlash('sonata_flash_error', ' The start date must be greater than the end date');
                return $this->redirect($this->admin->generateUrl('form-circuit-season-date', array('id' => $circuit_season->getId())));
            }

            $all_dates = array();
            $daterange = new \DatePeriod($data['startdate'], new \DateInterval('P1D'), $data['enddate']);

            foreach ($daterange as $date) {
                $all_dates[] = $date;
            }
            $all_dates[] = $data['enddate'];
            
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
            return $this->redirect($this->admin->generateUrl('form-circuit-season-date', array('id' => $circuit_season->getId())));
        }


        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->redirect($this->admin->generateUrl('form-circuit-season-date', array('id' => $circuit_season->getId())));
    }

    private function formCreateDatesForCircuitSeason($circuit_season) {
        $form = $this->createFormBuilder(
                        array(), array(), array(
                    'action' => $this->admin->generateUrl('create-circuit-season-date-for-circuit'),
                    'method' => 'POST'))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Satart Date',
                    'required' => true,
                    'data' => $this->getCircuitSeasonStartDate($circuit_season)
                ))
                ->add('enddate', 'sonata_type_date_picker', array(
                    'label' => 'End Date',
                    'required' => true,
                    'data' => $this->getCircuitSeasonEndDate($circuit_season)
                ))
                ->getForm();

        return $form;
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
            return (new \DateTime('now'));
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

}
