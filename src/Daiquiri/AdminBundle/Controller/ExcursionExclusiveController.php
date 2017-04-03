<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;


/**
 * Excursion Exclusive controller.
 *
 */
class ExcursionExclusiveController extends SonataCRUDController {

    public function formExcursionExclusiveSearcherAction($id) {
        return $this->forward('DaiquiriReservationBundle:ExcursionSearcher:getFormIntoExcursionSearcher', array(
                    'id' => $id,
                    '_sonata_admin' => 'admin.excursion.searcher',
                    'view_render' => 'DaiquiriReservationBundle:Excursion:form_searcher_into_excursion.html.twig',
        ));
    }

    

    public function renderResultItemExcursionExclusiveAction($obj, $searcher) {
        if ($obj) {
            $form_item = $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionExclusiveItemType(), new \Daiquiri\ReservationBundle\Entity\ExcursionExclusiveItem(), array());
            return $this->render('DaiquiriReservationBundle:Excursion:result_item_excursion.html.twig', array(
                        'obj' => $obj,
                        'form_item' => $form_item->createView(),
                        'searcher' => $searcher,
                        'colective' => false
            ));
        }
        return new Response();
    }

    public function addToCartAction(Request $request) {
        return $this->forward('DaiquiriReservationBundle:CartItem:addExcursionExclusive', array('request' => $request));
    }

    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DaiquiriAdminBundle:ExcursionExclusive')->find($id);

        $request = new \Daiquiri\ReservationBundle\Entity\ExcursionRequest();

        $request->setExcursion($entity);


        $disable_day_of_week = array();
        if (!$entity->getSunday()) {
            $disable_day_of_week[] = 0;
        }
        if (!$entity->getMonday()) {
            $disable_day_of_week[] = 1;
        }
        if (!$entity->getThuesday()) {
            $disable_day_of_week[] = 2;
        }
        if (!$entity->getWednesday()) {
            $disable_day_of_week[] = 3;
        }
        if (!$entity->getThursday()) {
            $disable_day_of_week[] = 4;
        }
        if (!$entity->getFriday()) {
            $disable_day_of_week[] = 5;
        }
        if (!$entity->getSaturday()) {
            $disable_day_of_week[] = 6;
        }

        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionRequestType(), $request, array(
            'disable_date_of_week' => $disable_day_of_week,
            'action' => $this->generateUrl('create-request-for-excursion-exclusive')
        ));


        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'object' => $entity
        ));
    }

}
