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
class PackageController extends SonataCRUDController {

    public function formPackageOptionItemAction() {
        $em = $this->getDoctrine()->getManager();
        $entity = new \Daiquiri\ReservationBundle\Entity\PackageOptionSearcher();

        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\PackageOptionSearcherType(), $entity, array());
        return $this->render('DaiquiriReservationBundle:Package:form_searcher.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function findPackageOptionSearcherAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $searcher = new \Daiquiri\ReservationBundle\Entity\PackageOptionSearcher();

        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\PackageOptionSearcherType(), $searcher, array());

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($this->get('validate')->isMoreThanMinDate($searcher->getStartdate())) {
                $available = $this->get('app.searcher_controller')->PackageOptionSearcher($searcher);
                return $this->render('DaiquiriReservationBundle:Package:form_searcher.html.twig', array(
                            'form' => $form->createView(),
                            'available' => $available,
                            'searcher' => $searcher
                ));
            } else {
                $this->addFlash('sonata_flash_error', 'The departure date must be less that check out date and ' . '.The dates must be from  ' . (new \DateTime('now'))->modify('+ 4 days')->format("M j, Y"));
                return $this->render('DaiquiriReservationBundle:Package:form_searcher.html.twig', array(
                            'form' => $form->createView(),
                ));
            }
        }
        $this->addFlash('sonata_flash_error', 'Form data is not Valid, please check it');
        return $this->render($this->admin->generateUrl('form-package-option-item'));
    }

    public function renderResultItemPackageOptionAction($obj, $searcher) {
        if ($obj) {
            $salida = array();
            foreach ($obj as $o) {
                $form_item = $this->createForm(new \Daiquiri\ReservationBundle\Form\PackageOptionItemType(), new \Daiquiri\ReservationBundle\Entity\PackageOptionItem(), array());
                $salida[] = array('form' => $form_item->createView(), 'obj' => $o);
            }
            return $this->render('DaiquiriReservationBundle:Package:result_item_packageoption.html.twig', array(
                        'salida' => $salida,
                        'searcher' => $searcher
            ));
        }
    }

    public function addToCartAction(Request $request) {

        return $this->forward('DaiquiriReservationBundle:CartItem:addPackageOptionItem', array('request' => $request));
    }

   

    public function ApplyAction($id, $f, $b) {
        $em = $this->getDoctrine()->getManager();
        $package = $em->getRepository('DaiquiriAdminBundle:Package')->find($id);

        $object = new \Daiquiri\ReservationBundle\Entity\PackageRequest();
        $object->setPackage($package);

        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\PackageRequestType(), $object, array(
            'action' => $this->generateUrl('create-request-for-package')
        ));        
        return $this->render('Daiquiri' . $b . 'Bundle:' . $f . ':request_form.html.twig', array(
                    'form' => $form->createView(),
                    'object' => $package
        ));
    }

}
