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
class MedicalServiceController extends SonataCRUDController {

    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $medicalservice = $em->getRepository('DaiquiriAdminBundle:MedicalService')->find($id);

        $object = new \Daiquiri\ReservationBundle\Entity\MedicalRequest();
        $object->setMedicalservice($medicalservice);

        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\MedicalRequestType(), $object, array(
            'action' => $this->generateUrl('create-request-for-medical')
        ));
        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'object' => $medicalservice
        ));
    }

}
