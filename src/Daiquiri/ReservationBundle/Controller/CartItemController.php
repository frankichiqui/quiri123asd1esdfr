<?php

namespace Daiquiri\ReservationBundle\Controller;

use Daiquiri\ReservationBundle\Entity\CartItem;
use Daiquiri\ReservationBundle\Entity\CarItem;
use Daiquiri\ReservationBundle\Entity\CircuitItem;
use Daiquiri\ReservationBundle\Entity\ColectiveTransferItem;
use Daiquiri\ReservationBundle\Entity\ExclusiveTransferItem;
use Daiquiri\ReservationBundle\Entity\OcupationItem;
use Daiquiri\ReservationBundle\Entity\PackageOption;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartItemController extends Controller {

    public function addPackageOptionItemAction(Request $request) {
        $entityItem = new \Daiquiri\ReservationBundle\Entity\PackageOptionItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\PackageOptionItemType(), $entityItem, array());
        $form->handleRequest($request);
        //dump($form->getData());die;
        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->incrementQuantity();
                $aux->setTotalprice($aux->getTotalprice() + $aux->getProduct()->getPrice($aux, $this->get('market')->getObject()));
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                $content = $this->renderView('DaiquiriReservationBundle:Package:reservation_detail.html.twig', array(
                    'caritem' => $aux
                ));
                return new Response(json_encode(array(
                            'title' => $entityItem->getTitle(),
                            'success' => true,
                            'isnew' => false,
                            'content' => $content,
                            'msg' => 'increment quantity item:' . $aux->getId())));
            } else {
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                $content = $this->renderView('DaiquiriReservationBundle:Package:reservation_detail.html.twig', array(
                    'caritem' => $entityItem
                ));
                return new Response(json_encode(array(
                            'title' => $entityItem->getTitle(),
                            'success' => true,
                            'isnew' => true,
                            'content' => $content,
                            'msg' => 'add new  item:' . $entityItem->getId())));
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => $form->getData(),
                    'msg' => 'Form is not valid')));
    }

    //annadir un circuit  al carrito
    public function addCircuitItemAction(Request $request) {
        $front = $request->request->all()['daiquiri_reservationbundle_circuititem']['front'];

        $entityItem = new \Daiquiri\ReservationBundle\Entity\CircuitItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\CircuitItemType(), $entityItem, array());
        $form->handleRequest($request);
        //dump($form->getData());die;
        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->quantityplus1();
                $aux->setTotalprice($aux->getTotalprice() + $aux->getProduct()->getPrice($aux, $this->get('market')->getObject()));
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Circuit:reservation_detail.html.twig', array(
                        'caritem' => $aux
                    ));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Circuit:reservation_detail.html.twig', array(
                        'caritem' => $aux
                    ));
                }
                return new Response(json_encode(array(
                            'front' => $front,
                            'title' => $entityItem->getTitle(),
                            'success' => true,
                            'isnew' => false,
                            'content' => $content,
                            'msg' => 'increment quantity item:' . $aux->getId())));
            } else {
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Circuit:reservation_detail.html.twig', array(
                        'caritem' => $entityItem
                    ));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Circuit:reservation_detail.html.twig', array(
                        'caritem' => $entityItem
                    ));
                }
                return new Response(json_encode(array(
                            'front' => $front,
                            'title' => $entityItem->getTitle(),
                            'success' => true,
                            'isnew' => true,
                            'content' => $content,
                            'msg' => 'add new  item:' . $entityItem->getId())));
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => $form->getData(),
                    'msg' => 'Form is not valid')));
    }

    //annadir una room  al carrito
    public function addOcupationItemAction(Request $request, $id) {
        //dump($request);die;
        $front = $request->request->all()['daiquiri_reservationbundle_ocupationitem']['front'];
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
        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->incrementQuantity();
                $plus_diet = $aux->getHotel()->getPlusForDiet($aux);
                $aux->setTotalprice($aux->getProduct()->getPrice($aux, $this->get('market')->getObject()) + $plus_diet);
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Hotel:reservation_detail.html.twig', array(
                        'caritem' => $aux
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId()
                    )));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Hotel:reservation_detail.html.twig', array(
                        'caritem' => $aux
                    ));
                    return new Response(json_encode(array(
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId()
                    )));
                }
            } else {
                $plus_diet = $entityItem->getHotel()->getPlusForDiet($entityItem);
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()) + $plus_diet);
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Hotel:reservation_detail.html.twig', array(
                        'caritem' => $entityItem,
                    ));
                    return new Response(json_encode(array(
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId()
                    )));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Hotel:reservation_detail.html.twig', array(
                        'caritem' => $entityItem,
                    ));
                    return new Response(json_encode(array(
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId()
                    )));
                }
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => $form->getData(),
                    'msg' => 'Form is not valid'
        )));
    }

    //annadir un transfer colectivo al carrito
    public function addTransferColectiveAction(Request $request) {
        //dump($request->request->all());die;
        $front = $request->request->all()['daiquiri_reservationbundle_transfercolectiveitem']['front'];

        $entityItem = new \Daiquiri\ReservationBundle\Entity\TransferColectiveItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferColectiveItemType(), $entityItem, array());
        $form->handleRequest($request);
        //dump($form);die;
        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }

            $entityItem->GenerateId();
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->quantityplus1();
                $aux->setTotalprice($aux->getTotalprice() + $aux->getProduct()->getPrice($aux, $this->get('market')->getObject()));
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $aux,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $aux,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                }
            } else {
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $entityItem,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $entityItem,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                }
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => $form->getData(),
                    'msg' => 'Form is not valid')));
    }

    //annadir un transfer exclusive al carito 
    public function addTransferExclusiveAction(Request $request) {
        //dump($request->request->all());die;
        $front = $request->request->all()['daiquiri_reservationbundle_transferexclusiveitem']['front'];

        $entityItem = new \Daiquiri\ReservationBundle\Entity\TransferExclusiveItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\TransferExclusiveItemType(), $entityItem, array());
        $form->handleRequest($request);
        //dump($entityItem);die;
        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->quantityplus1();
                $aux->setTotalprice($aux->getTotalprice() + $aux->getProduct()->getPrice($aux, $this->get('market')->getObject()));
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $aux,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $aux,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                }
            } else {
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $entityItem,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Transfer:reservation_detail.html.twig', array(
                        'caritem' => $entityItem,
                        'colective' => true
                    ));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                }
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => $form->getData(),
                    'msg' => 'Form is not valid')));
    }

    //anadir una excursion exclusiva al carrito
    public function addExcursionExclusiveAction(Request $request) {
        $front = $request->request->all()['daiquiri_reservationbundle_excursionexclusiveitem']['front'];

        $entityItem = new \Daiquiri\ReservationBundle\Entity\ExcursionExclusiveItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionExclusiveItemType(), $entityItem, array());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $entityItem->setDropoffplace($entityItem->getPickupplace());
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->$aux->quantityplus1();
                $aux->setTotalprice($aux->getTotalprice() + $aux->getProduct()->getPrice($aux, $this->get('market')->getObject()));
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Excursion:reservation_detail.html.twig', array('caritem' => $aux));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                } else {

                    $content = $this->renderView('DaiquiriReservationBundle:Excursion:reservation_detail.html.twig', array('caritem' => $aux));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                }
            } else {
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Excursion:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Excursion:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                }
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => 'Error to comunicated',
                    'msg' => 'Form is not valid')));
    }

    //anadir una excursion colectiva al carrito
    public function addExcursionColectiveAction(Request $request) {
        $front = $request->request->all()['daiquiri_reservationbundle_excursioncolectiveitem']['front'];

        $entityItem = new \Daiquiri\ReservationBundle\Entity\ExcursionColectiveItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\ExcursionColectiveItemType(), $entityItem, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $entityItem->setDropoffplace($entityItem->getPickupplace());
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->quantityplus1();
                $aux->setTotalprice($aux->getTotalprice() + $aux->getProduct()->getPrice($aux, $this->get('market')->getObject()));
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Excursion:reservation_detail.html.twig', array('caritem' => $aux));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Excursion:reservation_detail.html.twig', array('caritem' => $aux));
                    return new Response(json_encode(array(
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                }
            } else {
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Excursion:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Excursion:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new  item:' . $entityItem->getId())));
                }
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => 'Error to comunicated',
                    'msg' => 'Form is not valid')));
    }

    //anadir una room de una casa de renta al carrito
    public function addRentalHouseRoomItemAction(Request $request) {
        // dump($request);die;
        $front = $request->request->all()['daiquiri_reservationbundle_rentalhouseroomitem']['front'];

        $entityItem = new \Daiquiri\ReservationBundle\Entity\RentalHouseRoomItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\RentalHouseRoomItemType, $entityItem, array());
        $form->handleRequest($request);

        if ($form->isValid()) {

            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
            $item = $this->isExistItemAction($request, $entityItem->getId());

            if ($item > -1) {
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:RentalHouse:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => 'This item alredy exist in Sopping Cart.',
                                'msg' => 'This item alredy exist in Sopping Cart.')));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:RentalHouse:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => 'This item alredy exist in Sopping Cart.',
                                'msg' => 'This item alredy exist in Sopping Cart.')));
                }
            } else {
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:RentalHouse:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new item:' . $entityItem->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:RentalHouse:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new item:' . $entityItem->getId())));
                }
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => 'Error to comunicated',
                    'msg' => 'Form is not valid')));
    }

    //anadir un carro al carrito
    public function addCarItemAction(Request $request) {
        //dump($request->request->all());die;
        $front = $request->request->all()['daiquiri_reservationbundle_caritem']['front'];

        $entityItem = new CarItem();
        $form = $this->createForm(new \Daiquiri\ReservationBundle\Form\CarItemType(), $entityItem, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $cart = $request->getSession()->get("cart");
            if (!$cart) {
                $this->createNewAction($request);
            }
            $entityItem->GenerateId();
            $item = $this->isExistItemAction($request, $entityItem->getId());
            if ($item > -1) {
                $aux = $cart[$item];
                array_splice($cart, $item, 1);
                $aux = unserialize($aux);
                $aux->quantityplus1();
                $aux->setTotalprice($aux->getTotalprice() + $aux->getProduct()->getPrice($aux, $this->get('market')->getObject()));
                $cart[] = serialize($aux);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Car:reservation_detail.html.twig', array('caritem' => $aux));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Car:reservation_detail.html.twig', array('caritem' => $aux));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => false,
                                'content' => $content,
                                'msg' => 'increment quantity item:' . $aux->getId())));
                }
            } else {
                $entityItem->setTotalprice($entityItem->getProduct()->getPrice($entityItem, $this->get('market')->getObject()));
                $cart[] = serialize($entityItem);
                $request->getSession()->set('cart', $cart);
                $this->UpdateCartAction($request);
                if ($front == 1) {
                    $content = $this->renderView('DaiquiriSiteBundle:Car:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new item:' . $entityItem->getId())));
                } else {
                    $content = $this->renderView('DaiquiriReservationBundle:Car:reservation_detail.html.twig', array('caritem' => $entityItem));
                    return new Response(json_encode(array(
                                'front' => $front,
                                'title' => $entityItem->getTitle(),
                                'success' => true,
                                'isnew' => true,
                                'content' => $content,
                                'msg' => 'add new item:' . $entityItem->getId())));
                }
            }
        }
        return new Response(json_encode(array(
                    'success' => false,
                    'isnew' => false,
                    'content' => "Error to comunicate with dthe server",
                    'msg' => 'Form is not valid')));
    }

    //crea un nuevo carrito vacio, emptycar
    public function createNewAction(Request $request) {
        $session = $request->getSession();
        $session->set('cart', array());
        $session->set('cart_count', 0);
        $session->set('cart_total', 0);
        return new Response(json_encode(array('success' => true, 'msg' => 'created new')));
    }

    // eliminar todos los item del carrito
    public function emptyCartAction(Request $request) {
        $session = $request->getSession();
        $session->set('cart', array());
        $session->set('cart_count', 0);
        $session->set('cart_total', 0);
        return new Response(json_encode(array('success' => true, 'msg' => 'All item was removed...')));
    }

    public function getTotalCartAction(Request $request) {
        return new Response($this->container->get('reservation.twig.price_extension')->priceFilter($request->getSession()->get('cart_total', 0)));
    }

    public function getCountCartAction(Request $request) {
        return new Response(json_encode(array(
                    'success' => true,
                    'value' => $request->getSession()->get('cart_count', 0))));
    }

//devuelve el item cart si existe, null en caso contrario
    private function isExistItemAction(Request $request, $id) {
        $cart = $request->getSession()->get("cart");
        if (!$cart) {
            $this->createNewAction($request);
            return -1;
        }
        if (count($cart) > 0) {
            foreach ($cart as $key => $item) {
                $it = unserialize($item);
                if ($it->getId() == $id) {
                    return $key;
                }
            }

            return -1;
        }

        return -1;
    }

    public function deleteItemByIdAction(Request $request, $id) {
        $cart = $request->getSession()->get("cart");
        if (!$cart) {
            $this->createNewAction($request);
            $this->UpdateCartAction($request);
            return new Response(json_encode(array(
                        'success' => true,
                        'msg' => 'Shopping Cart is empty .Create new')));
        }
        $cart_aux = array();
        if (count($cart) > 0) {
            foreach ($cart as $key => $item) {
                $it = unserialize($item);
                if ($it->getId() != $id) {
                    $cart_aux[] = $item;
                }
            }
            $request->getSession()->set('cart', $cart_aux);
            $this->UpdateCartAction($request);
            return new Response(json_encode(array(
                        'success' => true,
                        'msg' => 'Item was removed')));
        }
        $this->UpdateCartAction($request);
        return new Response(json_encode(array(
                    'success' => true,
                    'msg' => 'Shopping Cart is empty.')));
    }

    //eliminar un item por el idexdel carrito
    public function deleteItemAction(Request $request, $index) {
        $cart = $request->getSession()->get("cart");
        if (!$cart) {
            $this->createNewAction($request);
            return new Response(json_encode(array(
                        'success' => false,
                        'msg' => 'cart empty')));
        }
        if ($index > count($cart)) {
            return new Response(json_encode(array(
                        'success' => false,
                        'msg' => 'indice offset')));
        }
        if ($request->getSession()->get("cart_count", 0) == 1) {
            $this->createNewAction($request);
            return new Response(json_encode(array('success' => true, 'msg' => 'item deteled')));
        }
        $cart = array_splice($cart, $index, 1);
        $request->getSession()->set('cart', $cart);
        $this->UpdateCartAction($request);
        return new Response(json_encode(array(
                    'success' => true,
                    'msg' => 'item deteled')));
    }

    //vista minima del carrito de compra
    public function getMinViewCartAction() {
        $view_render = $this->getRequest()->get('view_render', 'DaiquiriReservationBundle:Default:cartmin.html.twig');
        return $this->render($view_render);
    }

    public function UpdateCartAction(Request $request) {
        $cart = $request->getSession()->get("cart");
        if (!$cart) {
            $this->createNewAction($request);
            return new Response(json_encode(array('success' => false, 'msg' => 'cart neww')));
        }
        $total = 0;
        foreach ($cart as $item) {
            $total += unserialize($item)->getTotalprice();
        }
        $request->getSession()->set('cart_total', $total);
        $request->getSession()->set('cart_count', count($cart));
        return new Response(json_encode(array('success' => true, 'msg' => 'cart updated')));
    }

// devuelve el aray de objertos del carrito
    public function getArrayCartAction(Request $request, $em) {
        $cart = $request->getSession()->get("cart");
        if (!$cart) {
            $this->createNewAction($request);
            return array();
        }
        $cart_aux = array();
        foreach ($cart as $item) {
            $unserialized = unserialize($item);
            $cart_aux[] = $this->getRealItemAction($unserialized, $em);
        }
        return $cart_aux;
    }

    //retorna un item real, debido a la perdida de info cuando se guarda en la session
    public function getRealItemAction($item, $em) {

        $item->setProduct($em->getRepository('DaiquiriAdminBundle:Product')->find($item->getProduct()->getId()));

        if ($item instanceof CarItem) {
            $pp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getPickupplace()->getId());
            $item->setPickupplace($pp);
            $dp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getDropoffplace()->getId());
            $item->setDropoffplace($dp);

            return $item;
        }
        if ($item instanceof CircuitItem) {
            $pp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getPickupplace()->getId());


            return $item;
        }
        if ($item instanceof \Daiquiri\ReservationBundle\Entity\ExcursionColectiveItem) {
            $pp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getPickupplace()->getId());
            $item->setPickupplace($pp);
            $dp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getDropoffplace()->getId());
            $item->setDropoffplace($dp);

            return $item;
        }
        if ($item instanceof \Daiquiri\ReservationBundle\Entity\ExcursionExclusiveItem) {
            $pp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getPickupplace()->getId());
            $item->setPickupplace($pp);
            $dp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getDropoffplace()->getId());
            $item->setDropoffplace($dp);

            return $item;
        }
        if ($item instanceof \Daiquiri\ReservationBundle\Entity\OcupationItem) {
            $hotel = $em->getRepository('DaiquiriAdminBundle:Hotel')->find($item->getHotel()->getId());
            $item->setHotel($hotel);
            $room = $em->getRepository('DaiquiriAdminBundle:Room')->find($item->getRoom()->getId());
            $item->setRoom($room);

            return $item;
        }
        if ($item instanceof \Daiquiri\ReservationBundle\Entity\PackageOptionItem) {
            $pp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getPickupplace()->getId());
            $item->setDropoffplace($dp);

            return $item;
        }
        if ($item instanceof \Daiquiri\ReservationBundle\Entity\RentalHouseRoomItem) {
            $rentalhouse = $em->getRepository('DaiquiriAdminBundle:RentalHouse')->find($item->getRentalhouse()->getId());
            $item->setRentalhouse($rentalhouse);
            $room = $em->getRepository('DaiquiriAdminBundle:RentalHouseRoom')->find($item->getRoom()->getId());
            $item->setRoom($room);

            return $item;
        }
        if ($item instanceof \Daiquiri\ReservationBundle\Entity\TransferColectiveItem) {
            $pp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getPickupplace()->getId());
            $item->setPickupplace($pp);
            $dp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getDropoffplace()->getId());
            $item->setDropoffplace($dp);

            if ($item->getFlight()) {
                $flight = $em->getRepository('DaiquiriAdminBundle:Flight')->find($item->getFlight()->getId());
                $item->setFlight($flight);
            }

            return $item;
        }
        if ($item instanceof \Daiquiri\ReservationBundle\Entity\TransferExclusiveItem) {
            $pp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getPickupplace()->getId());
            $item->setPickupplace($pp);
            $dp = $em->getRepository('DaiquiriAdminBundle:Place')->find($item->getDropoffplace()->getId());
            $item->setDropoffplace($dp);

            if ($item->getFlight()) {
                $flight = $em->getRepository('DaiquiriAdminBundle:Flight')->find($item->getFlight()->getId());
                $item->setFlight($flight);
            }
            return $item;
        }
    }

    //incrementar la cuantity de un item en x 
    public function incrementItemQuantityAction(Request $request, $id, $newquantity) {
        $cart = $request->getSession()->get("cart");
        if (!$cart) {
            $this->createNewAction($request);
            return new Response(json_encode(array('success' => false, 'msg' => 'cart new')));
        }
        $index = $this->isExistItemAction($request, $id);
        if ($index > -1) {
            $item = unserialize($cart[$index]);
            $item->setQuantity($newquantity);
            $cart[$index] = serialize($item);
            $request->getSession()->set('cart', $cart);
            return new Response(json_encode(array('success' => true, 'msg' => 'set quantity by' . $newquantity)));
        }
        return new Response(json_encode(array('success' => false, 'msg' => 'item no exist')));
    }

    public function getItemCartMinAction(CartItem $it, $bundle = "DaiquiriReservationBundle", $view_render_name = 'item_cart_min.html.twig') {

        $request = $this->getRequest();
        $front = $request->get('front');
        if ($front == 1) {
            $bundle = "DaiquiriSiteBundle";
            $view_render_name = 'item_cart_detail.html.twig';
        }

        $em = $this->getDoctrine()->getManager();
        if ($it->getProduct() instanceof \Daiquiri\AdminBundle\Entity\RentalHouseRoom) {
            $product = $em->getRepository('DaiquiriAdminBundle:RentalHouseRoom')->findOneById($it->getProduct()->getId());
            return $this->render($bundle . ':RentalHouse:' . $view_render_name, array(
                        'it' => $it,
                        'product' => $product));
        }
        if ($it->getProduct() instanceof \Daiquiri\AdminBundle\Entity\Car) {
            $product = $em->getRepository('DaiquiriAdminBundle:Car')->findOneById($it->getProduct()->getId());
            return $this->render($bundle . ':Car:' . $view_render_name, array(
                        'it' => $it,
                        'product' => $product));
        }
        if ($it->getProduct() instanceof \Daiquiri\AdminBundle\Entity\Excursion) {
            $product = $em->getRepository('DaiquiriAdminBundle:Excursion')->findOneById($it->getProduct()->getId());
            return $this->render($bundle . ':Excursion:' . $view_render_name, array(
                        'it' => $it,
                        'product' => $product));
        }

        if ($it->getProduct() instanceof \Daiquiri\AdminBundle\Entity\Transfer) {
            $product = $em->getRepository('DaiquiriAdminBundle:Transfer')->findOneById($it->getProduct()->getId());
            return $this->render($bundle . ':Transfer:' . $view_render_name, array(
                        'it' => $it,
                        'product' => $product));
        }
        if ($it->getProduct() instanceof \Daiquiri\AdminBundle\Entity\Ocupation) {
            $product = $em->getRepository('DaiquiriAdminBundle:Ocupation')->findOneById($it->getProduct()->getId());
            return $this->render($bundle . ':Hotel:' . $view_render_name, array(
                        'it' => $it,
                        'product' => $product));
        }
        if ($it->getProduct() instanceof \Daiquiri\AdminBundle\Entity\Circuit) {
            $product = $em->getRepository('DaiquiriAdminBundle:Circuit')->findOneById($it->getProduct()->getId());
            return $this->render($bundle . ':Circuit:' . $view_render_name, array(
                        'it' => $it,
                        'product' => $product));
        }
        if ($it->getProduct() instanceof \Daiquiri\AdminBundle\Entity\PackageOption) {
            $product = $em->getRepository('DaiquiriAdminBundle:PackageOption')->findOneById($it->getProduct()->getId());

            return $this->render($bundle . ':Package:' . $view_render_name, array(
                        'it' => $it,
                        'product' => $product));
        }
    }

}
