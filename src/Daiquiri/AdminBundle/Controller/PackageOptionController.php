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
class PackageOptionController extends SonataCRUDController {

    

    public function formPackageOptionSearcherAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = new \Daiquiri\ReservationBundle\Entity\CircuitSearcher();
        $circuit = $em->getRepository('DaiquiriAdminBundle:Circuit')->findOneById($id);
        if ($circuit) {
            $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\CircuitSearcherType(), $entity, array());
            return $this->render('DaiquiriReservationBundle:Circuit:form_searcher_into_circuit.html.twig', array(
                        'form' => $form->createView(),
                        'circuit' => $circuit));
        }
        $this->addFlash('sonata_flash_error', 'Circuit not found');
        return $this->render('DaiquiriReservationBundle:Circuit:form_searcher_into_circuit.html.twig', array(
        ));
    }

   

}
