<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\FormBuilder;
use Daiquiri\AdminBundle\Entity\Room;
use Daiquiri\AdminBundle\Entity\Ocupation;
use Daiquiri\AdminBundle\Entity\RoomAvailability;
use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Route\RouteCollection;

class RoomController extends Controller {

    public function formOcupationAction($id = null) {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->findOneById($id);

        if (!$room) {
            $this->addFlash('sonata_flash_error', 'The room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $ocupations_aux = $em->getRepository('DaiquiriAdminBundle:Ocupation')->findByRoom($room);
        $ocupations = array('ocupation10' => false, 'ocupation11' => false, 'ocupation12' => false, 'ocupation13' => false, 'ocupation20' => false, 'ocupation21' => false, 'ocupation22' => false, 'ocupation30' => false, 'ocupation31' => false, 'ocupation01' => false, 'ocupation02' => false, 'ocupation03' => false, 'ocupation04' => false);
        foreach ($ocupations_aux as $ocup) {
            $ocupations[$ocup->getTitle()] = true;
        }

        $form = $this->formCreateOcupation($ocupations);
        return $this->render('DaiquiriAdminBundle:Room:ocupation.html.twig', array(
                    'form' => $form->createView(),
                    'room' => $room
        ));
    }

    public function createOcupationForRoomAction(Request $request) {
        $id = $request->request->get('room');
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->findOneById($id);

        if (!$room) {
            $this->addFlash('sonata_flash_error', 'The room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $form = $this->formCreateOcupation($ocupations = null);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            if ($data['ocupation10'] == true) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 0))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(1);
                    $ocupation->setKids(0);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 0))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 0)));
                    $em->flush();
                }
            }

            if ($data['ocupation11']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 1))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(1);
                    $ocupation->setKids(1);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 1))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 1)));
                    $em->flush();
                }
            }


            if ($data['ocupation12']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 2))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(1);
                    $ocupation->setKids(2);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 2))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 2)));
                    $em->flush();
                }
            }

            if ($data['ocupation13']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 3))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(1);
                    $ocupation->setKids(3);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 3))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 1, 'kids' => 3)));
                    $em->flush();
                }
            }

            if ($data['ocupation20']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 0))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(2);
                    $ocupation->setKids(0);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 0))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 0)));
                    $em->flush();
                }
            }

            if ($data['ocupation21']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 1))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(2);
                    $ocupation->setKids(1);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 1))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 1)));
                    $em->flush();
                }
            }

            if ($data['ocupation22']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 2))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(2);
                    $ocupation->setKids(2);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 2))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 2, 'kids' => 2)));
                    $em->flush();
                }
            }

            if ($data['ocupation30']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 3, 'kids' => 0))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(3);
                    $ocupation->setKids(0);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 3, 'kids' => 0))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 3, 'kids' => 0)));
                    $em->flush();
                }
            }

            if ($data['ocupation31']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 3, 'kids' => 1))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(3);
                    $ocupation->setKids(1);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 3, 'kids' => 1))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 3, 'kids' => 1)));
                    $em->flush();
                }
            }

            if ($data['ocupation01']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 1))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(0);
                    $ocupation->setKids(1);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 1))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 1)));
                    $em->flush();
                }
            }

            if ($data['ocupation02']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 2))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(0);
                    $ocupation->setKids(2);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 2))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 2)));
                    $em->flush();
                }
            }

            if ($data['ocupation03']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 3))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(0);
                    $ocupation->setKids(3);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 3))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 3)));
                    $em->flush();
                }
            }

            if ($data['ocupation04']) {
                if (!$em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 4))) {
                    $ocupation = new Ocupation();
                    $ocupation->setRoom($room);
                    $ocupation->setAdults(0);
                    $ocupation->setKids(4);

                    $em->persist($ocupation);
                    $em->flush();
                }
            } else {
                if ($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 4))) {
                    $em->remove($em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneBy(array('room' => $room, 'adults' => 0, 'kids' => 4)));
                    $em->flush();
                }
            }
            $this->addFlash('sonata_flash_success', 'Create ocupations for room: ' . $room . ' successfully.');
            return $this->redirect($this->admin->generateUrl('form-ocupation', array('id' => $room->getId())));
        }

        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->redirect($this->admin->generateUrl('form-ocupation', array('id' => $room->getId())));
    }

    public function formCreateOcupation($ocupations = null) {
        $form = $this->createFormBuilder(
                        array(), array(), array(
                    'action' => $this->admin->generateUrl('create-ocupation-for-room'),
                    'method' => 'POST'))
                ->add('ocupation10', 'checkbox', array(
                    'label' => 'Ocupation 1-0',
                    'required' => false,
                    'data' => $ocupations['ocupation10']
                ))
                ->add('ocupation11', 'checkbox', array(
                    'label' => 'Ocupation 1-1',
                    'required' => false,
                    'data' => $ocupations['ocupation11']
                ))
                ->add('ocupation12', 'checkbox', array(
                    'label' => 'Ocupation 1-2',
                    'required' => false,
                    'data' => $ocupations['ocupation12']
                ))
                ->add('ocupation13', 'checkbox', array(
                    'label' => 'Ocupation 1-3',
                    'required' => false,
                    'data' => $ocupations['ocupation13']
                ))
                ->add('ocupation20', 'checkbox', array(
                    'label' => 'Ocupation 2-0',
                    'required' => false,
                    'data' => $ocupations['ocupation20']
                ))
                ->add('ocupation21', 'checkbox', array(
                    'label' => 'Ocupation 2-1',
                    'required' => false,
                    'data' => $ocupations['ocupation21']
                ))
                ->add('ocupation22', 'checkbox', array(
                    'label' => 'Ocupation 2-2',
                    'required' => false,
                    'data' => $ocupations['ocupation22']
                ))
                ->add('ocupation30', 'checkbox', array(
                    'label' => 'Ocupation 3-0',
                    'required' => false,
                    'data' => $ocupations['ocupation30']
                ))
                ->add('ocupation31', 'checkbox', array(
                    'label' => 'Ocupation 3-1',
                    'required' => false,
                    'data' => $ocupations['ocupation31']
                ))
                ->add('ocupation01', 'checkbox', array(
                    'label' => 'Ocupation 0-1',
                    'required' => false,
                    'data' => $ocupations['ocupation01']
                ))
                ->add('ocupation02', 'checkbox', array(
                    'label' => 'Ocupation 0-2',
                    'required' => false,
                    'data' => $ocupations['ocupation02']
                ))
                ->add('ocupation03', 'checkbox', array(
                    'label' => 'Ocupation 0-3',
                    'required' => false,
                    'data' => $ocupations['ocupation03']
                ))
                ->add('ocupation04', 'checkbox', array(
                    'label' => 'Ocupation 0-4',
                    'required' => false,
                    'data' => $ocupations['ocupation04']
                ))
                ->getForm();

        return $form;
    }

    //For Room Availability'


    public function formAvailabilityAction($id = null) {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->findOneById($id);

        if (!$room) {
            $this->addFlash('sonata_flash_error', 'The room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }

        $form = $this->formCreateAvailability($room->getId());
        return $this->render('DaiquiriAdminBundle:RoomAvailability:availability.html.twig', array(
                    'form' => $form->createView(),
                    'room' => $room
        ));
    }

    public function createAvailabilityForRoomAction(Request $request) {
        $id = $request->request->get('room');
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->findOneById($id);

        if (!$room) {
            $this->addFlash('sonata_flash_error', 'The room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $form = $this->formCreateAvailability($room->getId());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            if ($data['startdate'] >= $data['enddate']) {
                $this->addFlash('sonata_flash_error', ' The start date must be greater than the end date');
                return $this->redirect($this->admin->generateUrl('form-availability', array('id' => $room->getId())));
            }

            $all_dates = array();
            $daterange = new \DatePeriod($data['startdate'], new \DateInterval('P1D'), $data['enddate']);

            foreach ($daterange as $date) {
                $all_dates[] = $date;
            }
            $all_dates[] = $data['enddate'];

            foreach ($all_dates as $dates) {
                if (!$em->getRepository('DaiquiriAdminBundle:RoomAvailability')->findOneBy(array('room' => $room, 'date' => $dates))) {
                    $room_availability = new RoomAvailability();
                    $room_availability->setRoom($room);
                    $room_availability->setDate($dates);
                    $em->persist($room_availability);
                    $em->flush();
                }
            }
            $this->addFlash('sonata_flash_success', 'Create availabilities for room: ' . $room . ' successfully.');
            return $this->redirect($this->admin->generateUrl('form-availability', array('id' => $room->getId())));
        }


        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->redirect($this->admin->generateUrl('form-availability', array('id' => $room->getId())));
    }

    public function formCreateAvailability($id) {
        $form = $this->createFormBuilder(
                        array(), array(), array(
                    'action' => $this->admin->generateUrl('create-availability-for-room'),
                    'method' => 'POST'))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Satart Date',
                    'required' => true,
                    'data' => $this->getStartDateRoomAvailability($id)
                ))
                ->add('enddate', 'sonata_type_date_picker', array(
                    'label' => 'End Date',
                    'required' => true,
                    'data' => $this->getEndDateRoomAvailability($id)
                ))
                ->getForm();

        return $form;
    }

  

    public function getStartDateRoomAvailability($id) {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->findOneById($id);
        if (!$room) {
            $this->addFlash('sonata_flash_error', 'The Room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        if (count($room->getRoomAvailabilitys()) > 0) {
           
            return $room->getRoomAvailabilitys()[0]->getDate();
        } else {
            return new \Date('now');
        }
    }

    public function getEndDateRoomAvailability($id) {
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->findOneById($id);
        if (!$room) {
            $this->addFlash('sonata_flash_error', 'The Room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        if (count($room->getRoomAvailabilitys()) > 0) {
            return $room->getRoomAvailabilitys()[count($room->getRoomAvailabilitys()) - 1]->getDate();
        } else {
            return new \DateTime('now');
        }
    }

}
