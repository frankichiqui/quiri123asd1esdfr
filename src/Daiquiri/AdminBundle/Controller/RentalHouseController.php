<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Doctrine\ORM\EntityRepository;

use Daiquiri\ReservationBundle\Form\RentalHouseRoomItemType;

/**
 * Hotel controller.
 *
 */
class RentalHouseController extends SonataCRUDController {

    public function formRentalHouseRoomOcupationSearcherAction($id) {//       
        return $this->forward('DaiquiriReservationBundle:RentalHouseRoomSearcher:getFormIntoRentalHouse', array(
                    'id' => $id,
                    '_sonata_admin' => 'admin.rentalhouseroom.searcher',
                    'view_render' => 'DaiquiriReservationBundle:RentalHouse:form_searcher_into_rental_house.html.twig',
        ));
    }

  

    public function addToCartAction(Request $request) {
        return $this->forward('DaiquiriReservationBundle:CartItem:addRentalHouseRoomItem', array('request' => $request));
    }

    public function rentalhouseAvailabilityAction($id) {
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('DaiquiriAdminBundle:RentalHouse')->findOneById($id);
        if (!$hotel) {
            $this->addFlash('error', 'Not Found RentalHouse with ID' . $id);
            return $this->redirect($this->admin->generateObjectUrl('list', $hotel));
        }

        return $this->render('DaiquiriAdminBundle:RentalHouse:rentalhouse_availability.html.twig', array(
                    'rentalhouse' => $hotel,
        ));
    }

    public function setRentalhouseRoomAvailabilityAction($room, $date) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        try {
            $em = $this->getDoctrine()->getManager();
            $d = new \DateTime($date);
            $room = $em->getRepository('DaiquiriAdminBundle:RentalHouseRoom')->find($room);
        } catch (\Exception $e) {
            return new \Symfony\Component\HttpFoundation\Response(json_encode(array(
                        'success' => false,
                        'msg' => 'parameter is not valid'
            )));
        }
        $ra = $em->getRepository('DaiquiriAdminBundle:RentalHouseRoomAvailability')->findOneBy(array(
            'rental_house_room' => $room->getId(),
            'date' => $d
        ));
        if (!$ra) {
            $ra = new \Daiquiri\AdminBundle\Entity\RentalHouseRoomAvailability();
            $ra->setRentalHouseRoom($room);
            $ra->setDate($d);
            $em->persist($ra);
            $em->flush();
            return new \Symfony\Component\HttpFoundation\Response(json_encode(array(
                        'success' => true,
                        'msg' => 'Room ' . $room . ' is available in ' . $d->format('M j, Y'),
                        'class' => 'available'
            )));
        }

        $em->remove($ra);
        $em->flush();
        return new \Symfony\Component\HttpFoundation\Response(json_encode(array(
                    'success' => true,
                    'msg' => 'Room ' . $room . ' is not available in ' . $d->format('M j, Y'),
                    'class' => 'unavailable'
        )));
    }

    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $rental_house = $em->getRepository('DaiquiriAdminBundle:RentalHouse')->find($id);

        $rrental = new \Daiquiri\ReservationBundle\Entity\RentalHouseRequest();
        $rrental->setRentalhouse($rental_house);
        
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\RentalHouseRequestType(), $rrental, array(
            'action' => $this->generateUrl('create-request-for-rentalhouse')
        ));
        
        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'rentalhouse' => $rental_house
        ));
    }

    
    
}
