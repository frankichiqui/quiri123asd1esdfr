<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;

use Daiquiri\AdminBundle\Entity\HotelPrice;

/**
 * HotelPrice controller.
 *
 */
class HotelPriceController extends SonataCRUDController {

    private $errors;

    public function formSetHotelPriceAction($id) {
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('DaiquiriAdminBundle:Hotel')->find($id);
        if ($hotel) {
            $a = array();
            foreach ($hotel->getRooms() as $r) {
                $season = array();
                foreach ($hotel->getCurrentSeasons() as $s) {
                    $hotelprice = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->findOneBy(array('room' => $r->getId(), 'season' => $s->getId()));
                    if (!$hotelprice) {
                        $hotelprice = new \Daiquiri\AdminBundle\Entity\HotelPrice();
                        $hotelprice->setRoom($r);
                        $hotelprice->setSeason($s);
                        foreach ($r->getOcupations() as $o) {
                            $kidp = new \Daiquiri\AdminBundle\Entity\KidPolicy();
                            $kidp->setOcupation($o);
                            $hotelprice->addKidpolicy($kidp);
                        }
                    }

                    $season[] = array(
                        'season' => $s,
                        'hotelprice' => $hotelprice,
                        'form_hotelprice' => $this->get('admin.hotel.price')->getForm()->setData($hotelprice)->createView());
                }
                $a[] = array('room' => $r, 'seasons' => $season);
            }



            return $this->render('DaiquiriAdminBundle:Hotel:hotel_price.html.twig', array(
                        'hotel' => $hotel,
                        'data' => $a,
                        'admin_hotelprice' => $this->get('admin.hotel.price')
            ));
        }
        $this->addFlash('error', "Not found Hotel whit id " . $id);
        return $this->render($this->admin->generateUrl('list'));
    }

    public function getFormByHotelPriceAndIdAction($id_season, $id_room, $id_season_to_load = 0) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->find($id_room);
        $other = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->findBy(array('room' => $room->getId()));
        if ($id_season_to_load == 0) {
            $hotelprice = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->findOneBy(array('season' => $id_season, 'room' => $id_room));
            $season = $em->getRepository('DaiquiriAdminBundle:Season')->find($id_season);
            $current = $season;
            if (!$hotelprice) {
                $current = null;
                $hotelprice = new HotelPrice();
                $hotelprice->setRoom($room);
                $hotelprice->setSeason($season);
                foreach ($room->getOcupations() as $o) {
                    $kidp = new \Daiquiri\AdminBundle\Entity\KidPolicy();
                    $kidp->setOcupation($o);
                    $hotelprice->addKidpolicy($kidp);
                }
            }


            $hotelprice->sortKidPolicysByAdultAndKid();
            return $this->render('DaiquiriAdminBundle:HotelPrice:form_hotel_price.html.twig', array(
                        'form' => $this->admin->getForm()->setData($hotelprice)->createView(),
                        'object' => $hotelprice,
                        'other' => $other,
                        'current' => $current
            ));
        }
        $hotelprice = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->findOneBy(array('season' => $id_season_to_load, 'room' => $id_room));
        $season_load = null;
        if ($hotelprice) {
            $season_load = $hotelprice->getSeason();
            $hotelprice->sortKidPolicysByAdultAndKid();
        }

        return $this->render('DaiquiriAdminBundle:HotelPrice:form_hotel_price.html.twig', array(
                    'form' => $this->admin->getForm()->setData($hotelprice)->createView(),
                    'object' => $hotelprice,
                    'other' => $other,
                    'current' => $season_load,
        ));
    }

    public function getSeasonByRoomAction($id_room) {
        //ojo selecionar las season que tengan hotel price para poder cargarlos
        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->find($id_room);
        $ht = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->findBy(array('room' => $room->getId()));
        $salida = array();
        foreach ($ht as $h) {
            $salida[] = array('title' => $h->getSeason()->nameAndDates(), 'id_season' => $h->getSeason()->getId());
        }
        return new Response(json_encode($salida));
    }

    public function validateFormHotelPrice(HotelPrice $entity) {

//validacion del precio base
        $this->errors = array();
        if (!($entity->getBase() > 0)) {
            $this->errors[] = 'Price Base must be more than 0';
        }
//validacion del individual
        if ($entity->getCHindividual() == 1) {
            if (!($entity->getIndividual() >= 0 && $entity->getIndividual() <= 100))
                $this->errors[] = 'Field Individual Use must be between 0 and 100% ';
        }else
        if (!($entity->getIndividual() >= 0 )) {
            $this->errors[] = 'Field Individual Use must be more than 0 ';
        }
//validacion del 3er pax
        if ($entity->getCHthree() == 1) {
            if (!($entity->getThree() >= 0 && $entity->getThree() <= 100))
                $this->errors[] = 'Field 3tr Disscount must be between 0 and 100% ';
        }else
        if (!($entity->getThree() >= 0 )) {
            $this->errors[] = 'Field 3tr Disscount must be more than 0 ';
        }

        //validacion de los  kids price

        foreach ($entity->getKidpolicys() as $k) {
            $this->validateKidPolicy($k);
        }
    }

    public function validateKidPolicy(\Daiquiri\AdminBundle\Entity\KidPolicy $kidpolicy) {


        if ($kidpolicy->getKid1Choice() == 1) {
            if (!($kidpolicy->getKid1() <= 100 && $kidpolicy->getKid1() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 1st Kid must be betwing 0 and 100%';
            }
        } else {
            if (!($kidpolicy->getKid1() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 1st Kid must be more than 0';
            }
        }
        //kid 2
        if ($kidpolicy->getKid2Choice() == 1) {
            if (!($kidpolicy->getKid2() <= 100 && $kidpolicy->getKid2() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 2nd Kid must be betwing 0 and 100%';
            }
        } else {
            if (!($kidpolicy->getKid2() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 2nd Kid must be more than 0';
            }
        }
        //3th
        if ($kidpolicy->getKid3Choice() == 1) {
            if (!($kidpolicy->getKid3() <= 100 && $kidpolicy->getKid3() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 3th Kid must be betwing 0 and 100%';
            }
        } else {
            if (!($kidpolicy->getKid3() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 3th Kid must be more than 0';
            }
        }
        //4th
        if ($kidpolicy->getKid4Choice() == 1) {
            if (!($kidpolicy->getKid4() <= 100 && $kidpolicy->getKid4() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 4th Kid must be betwing 0 and 100%';
            }
        } else {
            if (!($kidpolicy->getKid4() >= 0)) {
                $this->errors[] = 'Discount on Ocupation(' . $kidpolicy->getOcupation()->getAdults() . '-' . $kidpolicy->getOcupation()->getKids() . ') in 4th Kid must be more than 0';
            }
        }
    }

    public function createAction() {
        $request = $this->getRequest();
        // the key used to lookup the template
        $templateKey = 'edit';
        $this->admin->checkAccess('create');
        $class = new \ReflectionClass($this->admin->hasActiveSubClass() ? $this->admin->getActiveSubClass() : $this->admin->getClass());
        if ($class->isAbstract()) {
            return $this->render(
                            'SonataAdminBundle:CRUD:select_subclass.html.twig', array(
                        'base_template' => $this->getBaseTemplate(),
                        'admin' => $this->admin,
                        'action' => 'create',
                            ), null, $request
            );
        }

        $object = $this->admin->getNewInstance();


        $preResponse = $this->preCreate($request, $object);
        if ($preResponse !== null) {
            return $preResponse;
        }

        $this->admin->setSubject($object);

        /** @var $form \Symfony\Component\Form\Form */
        $form = $this->admin->getForm();
        $form->setData($object);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            //TODO: remove this check for 4.0
            if (method_exists($this->admin, 'preValidate')) {
                $this->admin->preValidate($object);
            }
            $isFormValid = $form->isValid();

            // persist if the form was valid and if in preview mode the preview was approved
            if ($isFormValid && (!$this->isInPreviewMode($request) || $this->isPreviewApproved($request))) {
                $this->admin->checkAccess('create', $object);

                try {


                    $this->validateFormHotelPrice($object);
                    if (count($this->errors) > 0) {

                        return $this->renderJson(array(
                                    'success' => false,
                                    'content' => 'Form is not valid. Please check de values.',
                                    'errors' => $this->errors,
                                    'objectId' => $this->admin->getNormalizedIdentifier($object),
                                        ), 200, array());
                    }
                    $em = $this->getDoctrine()->getManager();
                    $search = $em->getRepository('DaiquiriAdminBundle:HotelPrice')->findOneBy(array(
                        'room' => $object->getRoom()->getId(),
                        'season' => $object->getSeason()->getId()));

                    if ($search) {
                        foreach ($search->getKidpolicys() as $k) {
                            $em->remove($k);
                            $em->flush();
                        }
                        $em->remove($search);
                        $em->flush();
                    }

                    $object = $this->admin->create($object);

                    $idk = '';
                    foreach ($object->getKidPolicys() as $k) {
                       // dump($k);die;
                        $idk.='-' . $k->getId();
                    }




                    if ($this->isXmlHttpRequest()) {
                        return $this->renderJson(array(
                                    'success' => true,
                                    'content' => 'Set price is successfull'.$object->getId().'['.$idk.']',
                                    'objectId' => $this->admin->getNormalizedIdentifier($object),
                                        ), 200, array());
                    }

                    $this->addFlash(
                            'sonata_flash_success', $this->admin->trans(
                                    'flash_create_success', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );

                    // redirect to edit mode
                    return $this->redirectTo($object);
                } catch (ModelManagerException $e) {
                    $this->handleModelManagerException($e);

                    $isFormValid = false;
                }
            }

            // show an error message if the form failed validation
            if (!$isFormValid) {
                if (!$this->isXmlHttpRequest()) {
                    $this->addFlash(
                            'sonata_flash_error', $this->admin->trans(
                                    'flash_create_error', array('%name%' => $this->escapeHtml($this->admin->toString($object))), 'SonataAdminBundle'
                            )
                    );
                }
            } else {
                return $this->renderJson(array(
                            'success' => false,
                            'content' => 'Form is not valid. Please check de values.',
                            'objectId' => $this->admin->getNormalizedIdentifier($object),
                                ), 200, array());
            }
        }
        return $this->renderJson(array(
                    'success' => false,
                    'content' => 'Form is not valid. Please check de values.',
                    'objectId' => $this->admin->getNormalizedIdentifier($object),
                        ), 200, array());
    }

}
