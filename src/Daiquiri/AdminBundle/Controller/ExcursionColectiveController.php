<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;


/**
 * TransferColective controller.
 *
 */
class ExcursionColectiveController extends SonataCRUDController {

    public function formExcursionColectiveSearcherAction($id) {

        return $this->forward('DaiquiriReservationBundle:ExcursionSearcher:getFormIntoExcursionSearcher', array(
                    'id' => $id,
                    '_sonata_admin' => 'admin.excursion.searcher',
                    'view_render' => 'DaiquiriReservationBundle:Excursion:form_searcher_into_excursion.html.twig',
        ));
    }

    public function renderResultItemExcursionColectiveAction($obj, $searcher) {
        if ($obj) {
            $form_item = $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionColectiveItemType, new \Daiquiri\ReservationBundle\Entity\ExcursionColectiveItem(), array());
            return $this->render('DaiquiriReservationBundle:Excursion:result_item_excursion.html.twig', array(
                        'obj' => $obj,
                        'form_item' => $form_item->createView(),
                        'searcher' => $searcher,
                        'colective' => true
            ));
        }
        return new Response();
    }

    public function addToCartAction(Request $request) {
        return $this->forward('DaiquiriReservationBundle:CartItem:addExcursionColective', array('request' => $request));
    }

   

    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DaiquiriAdminBundle:ExcursionColective')->find($id);

        $request = new \Daiquiri\ReservationBundle\Entity\ExcursionRequest();

        $request->setExcursion($entity);


        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionRequestType(), $request, array(
            'action' => $this->generateUrl('create-request-for-excursion-colective')
        ));
        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'object' => $entity
        ));
    }

}
