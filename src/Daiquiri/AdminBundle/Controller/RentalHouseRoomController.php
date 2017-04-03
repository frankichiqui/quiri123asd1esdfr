<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\FormBuilder;
use Daiquiri\AdminBundle\Entity\RentalHouseRoom;
use Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailability;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Route\RouteCollection;


class RentalHouseRoomController extends Controller {

    //For Rental House Room Availability


    public function formRentalHouseRoomAvailabilityAction($id = null) {
        $em = $this->getDoctrine()->getManager();
        $rental_house_room = $em->getRepository('DaiquiriAdminBundle:RentalHouseRoom')->findOneById($id);

        if (!$rental_house_room) {
            $this->addFlash('sonata_flash_error', 'The rental house room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $form = $this->formCreateRentalHouseRoomAvailability();
        return $this->render('DaiquiriAdminBundle:RentalHouseRoomAvailability:rental_house_room_availability.html.twig', array(
                    'form' => $form->createView(),
                    'rental_house_room' => $rental_house_room
        ));
    }

    public function createAvailabilityForRentalHouseRoomAction(Request $request) {
        $id = $request->request->get('rental_house_room');
        $em = $this->getDoctrine()->getManager();
        $rental_house_room = $em->getRepository('DaiquiriAdminBundle:RentalHouseRoom')->findOneById($id);

        if (!$rental_house_room) {
            $this->addFlash('sonata_flash_error', 'The rental house room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $form = $this->formCreateRentalHouseRoomAvailability();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            if ($data['startdate'] >= $data['enddate']) {
                $this->addFlash('sonata_flash_error', ' The start date must be greater than the end date');
                return $this->redirect($this->admin->generateUrl('form-rental-house-room-availability', array('id' => $rental_house_room->getId())));
            }

            $all_dates = array();
            $daterange = new \DatePeriod($data['startdate'], new \DateInterval('P1D'), $data['enddate']);

            foreach ($daterange as $date) {
                $all_dates[] = $date;
            }
            $all_dates[] = $data['enddate'];

            foreach ($all_dates as $dates) {
                if (!$em->getRepository('DaiquiriAdminBundle:RentalHouseRoomAvailability')->findOneBy(array('rental_house_room' => $rental_house_room, 'date' => $dates))) {
                    $room_availability = new RentalHouseRoomAvailability();
                    $room_availability->setRentalHouseRoom($rental_house_room);
                    $room_availability->setDate($dates);
                    $em->persist($room_availability);
                    $em->flush();
                }
            }
            $this->addFlash('sonata_flash_success', 'Create availabilities for rental house room: ' . $rental_house_room . ' successfully.');
            return $this->redirect($this->admin->generateUrl('form-rental-house-room-availability', array('id' => $rental_house_room->getId())));
        }


        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->redirect($this->admin->generateUrl('form-rental-house-room-availability', array('id' => $rental_house_room->getId())));
    }

    public function formCreateRentalHouseRoomAvailability() {
        $form = $this->createFormBuilder(
                        array(), array(), array(
                    'action' => $this->admin->generateUrl('create-availability-for-rental-house-room'),
                    'method' => 'POST'))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Satart Date',
                    'required' => true
                ))
                ->add('enddate', 'sonata_type_date_picker', array(
                    'label' => 'End Date',
                    'required' => true
                ))
                ->getForm();

        return $form;
    }



}
