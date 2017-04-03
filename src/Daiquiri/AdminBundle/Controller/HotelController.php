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


/**
 * Hotel controller.
 *
 */
class HotelController extends SonataCRUDController {

    

    //////////////////////////////////////////////////////////////////

    public function formOcupationSearcherAction($id) {
        return $this->forward('DaiquiriReservationBundle:OcupationSearcher:getFormIntoHotelSearcher', array(
                    'id' => $id,
                    '_sonata_admin' => 'admin.ocupation.searcher',
                    'view_render' => 'DaiquiriReservationBundle:Hotel:form_searcher_into_hotel.html.twig',
        ));
    }

    public function addToCartAction(Request $request, $id) {
        return $this->forward('DaiquiriReservationBundle:CartItem:addOcupationItem', array('request' => $request, 'id' => $id));
    }

   

    

    

   

  

//Create Ocupations
    public function formOcupationAction($id = null) {
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('DaiquiriAdminBundle:Hotel')->findOneById($id);
        if (!$hotel) {
            $this->addFlash('sonata_flash_error', 'The hotel with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $rooms = $hotel->getRooms();
        if (!$rooms) {
            $this->addFlash('sonata_flash_error', 'The hotel :' . $hotel->getTitle() . ' no have rooms.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $forms = array();
        foreach ($rooms as $room) {
            $ocupations_aux = $em->getRepository('DaiquiriAdminBundle:Ocupation')->findByRoom($room);
            $ocupations = array('ocupation10' => false, 'ocupation11' => false, 'ocupation12' => false, 'ocupation13' => false, 'ocupation20' => false, 'ocupation21' => false, 'ocupation22' => false, 'ocupation30' => false, 'ocupation31' => false, 'ocupation01' => false, 'ocupation02' => false, 'ocupation03' => false, 'ocupation04' => false);
            foreach ($ocupations_aux as $ocup) {
                $ocupations[$ocup->getTitle()] = true;
            }
            $form = $this->formCreateOcupation($ocupations);
            $forms[] = array('room' => $room, 'form' => $form->createView());
        }
        return $this->render('DaiquiriAdminBundle:Hotel:ocupation.html.twig', array(
                    'forms' => $forms,
                    'hotel' => $hotel
        ));
    }

    public function createOcupationForRoomAction(Request $request) {
        $id = $request->request->get('room');
        $hotel_id = $request->request->get('hotel');



        $em = $this->getDoctrine()->getManager();
        $room = $em->getRepository('DaiquiriAdminBundle:Room')->findOneById($id);
        if (!$room) {
            $this->addFlash('sonata_flash_error', 'The room with id :' . $id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }


//para devolver los forms 
        $hotel = $em->getRepository('DaiquiriAdminBundle:Hotel')->findOneById($hotel_id);
        if (!$hotel) {
            $this->addFlash('sonata_flash_error', 'The hotel with id :' . $hotel_id . ' is not found.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $rooms = $hotel->getRooms();
        if (!$rooms) {
            $this->addFlash('sonata_flash_error', 'The hotel :' . $hotel->getTitle() . ' no have rooms.');
            return $this->redirect($this->admin->generateUrl('list'));
        }
        $forms = array();
        foreach ($rooms as $r) {
            $ocupations_aux = $em->getRepository('DaiquiriAdminBundle:Ocupation')->findByRoom($r);
            $ocupations = array('ocupation10' => false, 'ocupation11' => false, 'ocupation12' => false, 'ocupation13' => false, 'ocupation20' => false, 'ocupation21' => false, 'ocupation22' => false, 'ocupation30' => false, 'ocupation31' => false, 'ocupation01' => false, 'ocupation02' => false, 'ocupation03' => false, 'ocupation04' => false);
            foreach ($ocupations_aux as $ocup) {
                $ocupations[$ocup->getTitle()] = true;
            }
            $form = $this->formCreateOcupation($ocupations);
            $forms[] = array('room' => $r, 'form' => $form->createView());
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

            if ($data['ocupation04'] == true) {
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
            return $this->redirect($this->admin->generateUrl('form-ocupation', array('id' => $hotel->getId())));
        }
        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->redirect($this->admin->generateUrl('form-ocupation', array('id' => $hotel->getId())));
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

   

    public function getPlusForDietAction(Request $request, $id, $diet) {
//dump($this->get('reservation.twig.price_extension')->getFilters());die;
                
        $request->request->set('_sonata_admin', 'admin.hotel');
        $price_function = $this->get('reservation.twig.price_extension')->getFilters()[0]->getCallable();
        $hotel = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:Hotel')->findOneById($id);
        if (!$hotel) {
            return new Response(json_encode(array(
                        'title' => "Hotel not found",
                        'success' => false,
                        'isnew' => false,
                        'content' => "Hotel with id" . $id . " not found",
                        'msg' => "Hotel with id" . $id . " not found"
            )));
        }
        $entityItem = new \Daiquiri\ReservationBundle\Entity\OcupationItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\OcupationItemType(), $entityItem, array('plan' => $hotel->getSimpleArrayAvailablePlan()));
        $form->handleRequest($request);
        
        //print_r($form->getErrors());die;
        if (!$form->isValid()) {
            return new Response(json_encode(array(
                        'success' => false,
                        'msg' => 'Error form',
                        
            )));
        }
        $value = ($entityItem->getHotel()->getPlusForDiet($entityItem));

        return new Response(json_encode(array(
                    'success' => true,
                    'value' => $price_function($value)
        )));
    }

    public function getPlaceTypeHotel() {
        $t = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:PlaceType')->findOneBy(array('title' => 'Hotel'));
        if (!$t) {
            $t = new \Daiquiri\AdminBundle\Entity\PlaceType();
            $t->setTitle('Hotel');
            $this->getDoctrine()->getManager()->persist($t);
            $this->getDoctrine()->getManager()->flush();
        }
        return $t;
    }

    public function createAction() { {
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
                        $object->addPlacetype($this->getPlaceTypeHotel());
                        $object = $this->admin->create($object);


                        if ($this->isXmlHttpRequest()) {
                            return $this->renderJson(array(
                                        'result' => 'ok',
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
                } elseif ($this->isPreviewRequested()) {
                    // pick the preview template if the form was valid and preview was requested
                    $templateKey = 'preview';
                    $this->admin->getShow();
                }
            }

            $view = $form->createView();

            // set the theme for the current Admin Form
            $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

            return $this->render($this->admin->getTemplate($templateKey), array(
                        'action' => 'create',
                        'form' => $view,
                        'object' => $object,
                            ), null);
        }
    }

    public function formHotelAvailabilityAction($id) {
        $em = $this->getDoctrine()->getManager();
        $hotel = $em->getRepository('DaiquiriAdminBundle:Hotel')->findOneById($id);
        if (!$hotel) {
            $this->addFlash('error', 'Not Found Hotel with ID' . $id);
            return $this->redirect($this->admin->generateObjectUrl('list', $hotel));
        }

        return $this->render('DaiquiriAdminBundle:Hotel:hotel_availability.html.twig', array(
                    'hotel' => $hotel,
        ));
    }

    public function setHotelRoomAvailabilityAction($room, $date) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        try {
            $em = $this->getDoctrine()->getManager();
            $d = new \DateTime($date);
            $room = $em->getRepository('DaiquiriAdminBundle:Room')->find($room);
        } catch (\Exception $e) {
            return new Response(json_encode(array(
                        'success' => false,
                        'msg' => 'parameter is not valid'
            )));
        }
        $ra = $em->getRepository('DaiquiriAdminBundle:RoomAvailability')->findOneBy(array(
            'room' => $room->getId(),
            'date' => $d
        ));
        if (!$ra) {
            $ra = new \Daiquiri\AdminBundle\Entity\RoomAvailability();
            $ra->setRoom($room);
            $ra->setDate($d);
            $em->persist($ra);
            $em->flush();
            return new Response(json_encode(array(
                        'success' => true,
                        'msg' => 'Room ' . $room . ' is available in ' . $d->format('M j, Y'),
                        'class' => 'available'
            )));
        }

        $em->remove($ra);
        $em->flush();
        return new Response(json_encode(array(
                    'success' => true,
                    'msg' => 'Room ' . $room . ' is not available in ' . $d->format('M j, Y'),
                    'class' => 'unavailable'
        )));
    }

    public function setHotelRoomAvailabilityRangeAction($room, $startdate, $enddate) {
        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }
        try {
            $em = $this->getDoctrine()->getManager();
            $start = new \DateTime($startdate);
            $end = new \DateTime($enddate);
            $room = $em->getRepository('DaiquiriAdminBundle:Room')->find($room);
            $interval = new \DateInterval('P1D');
            $daterange = new \DatePeriod($start, $interval, $end->modify('+1 day'));
            foreach ($daterange as $date) {
                $ra = $em->getRepository('DaiquiriAdminBundle:RoomAvailability')->findOneBy(array(
                    'room' => $room->getId(),
                    'date' => $date
                ));
                if (!$ra) {
                    $ra = new \Daiquiri\AdminBundle\Entity\RoomAvailability();
                    $ra->setRoom($room);
                    $ra->setDate($date);
                    $em->persist($ra);
                    $em->flush();
                }
            }

            return new Response(json_encode(array(
                        'success' => true,
                        'msg' => 'room is available between ' . $start->format('M j, Y') . " and " . $end->format('M j, Y')
            )));
        } catch (\Exception $e) {
            return new Response(json_encode(array(
                        'success' => false,
                        'msg' => 'parameter is not valid'
            )));
        }
    }

    public function formSetAvailability() {
        return $this->get('admin.roomavailability')->getForm();
    }

}
