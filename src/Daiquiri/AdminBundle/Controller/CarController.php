<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;


/**
 * Car controller.
 *
 */
class CarController extends SonataCRUDController {

    public function formCreateCarAvailabilityAction($id) {

        $em = $this->getDoctrine()->getManager();
        $object = $em->getRepository('DaiquiriAdminBundle:Car')->findOneById($id);
        if (!$object) {
            $this->addFlash('error', 'Not Found Car with ID' . $id);
            return $this->redirect($this->admin->generateObjectUrl('list', $object));
        }

        return $this->render('DaiquiriAdminBundle:Car:car_availability.html.twig', array(
                    'car' => $object,
        ));
    }

    public function setCarAvailabilityAction($car_id, $date) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        try {
            $em = $this->getDoctrine()->getManager();
            $d = new \DateTime($date);
            $car = $em->getRepository('DaiquiriAdminBundle:Car')->find($car_id);
        } catch (\Exception $e) {
            return new Response(json_encode(array(
                        'success' => false,
                        'msg' => 'parameter is not valid'
            )));
        }
        $ra = $car->isDepartureDate($d);
        if (!$ra) {
            $ra = new \Daiquiri\AdminBundle\Entity\CarAvailability();
            $car->addCarAvailability($ra);
            $ra->setDate($d);
            $em->persist($car);
            $em->persist($ra);
            $em->flush();
            return new Response(json_encode(array(
                        'success' => true,
                        'msg' => 'Car ' . $car . ' is available in ' . $d->format('M j, Y'),
                        'class' => 'available'
            )));
        }
        $ra = $this->getDoctrine()->getEntityManager()->createQuery('SELECT ca FROM DaiquiriAdminBundle:CarAvailability ca JOIN ca.cars c WHERE c.id = :car_id AND ca.date = :date')
                        ->setParameter('date', $d->format('Y-m-d'))
                        ->setParameter('car_id', $car->getId())->getResult();
        if (count($ra) > 0) {
            $em->remove($ra[0]);
            $em->flush();
        }
        return new Response(json_encode(array(
                    'success' => true,
                    'msg' => 'Car ' . $car . ' is not available in ' . $d->format('M j, Y'),
                    'class' => 'unavailable'
        )));
    }

    public function formCarSearcherAction($id) {
        return $this->forward('DaiquiriReservationBundle:CarSearcher:getFormIntoCarSearcher', array(
                    'id' => $id,
                    '_sonata_admin' => 'admin.car.searcher',
                    'view_render' => 'DaiquiriReservationBundle:Car:form_searcher_into_car.html.twig',
        ));
    }

    function renderDetailReservationAction(\Daiquiri\ReservationBundle\Entity\CarItem $caritem) {

        if ($caritem) {
            return $this->render('DaiquiriReservationBundle:Car:reservation_car_detail.html.twig', array('caritem' => $caritem));
        }
        return new Response();
    }

    public function addToCartAction(Request $request) {
        return $this->forward('DaiquiriReservationBundle:CartItem:addCarItem', array('request' => $request));
    }

   

    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $car = $em->getRepository('DaiquiriAdminBundle:Car')->find($id);

        $rcar = new \Daiquiri\ReservationBundle\Entity\CarRequest();
        $rcar->setCar($car);

        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\CarRequestType(), $rcar, array(
            'action' => $this->generateUrl('create-request-for-car')
        ));

        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'object' => $car
        ));
    }

}
