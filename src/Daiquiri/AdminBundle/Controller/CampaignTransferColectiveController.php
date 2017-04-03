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
 * Airport controller.
 *
 */
class CampaignTransferColectiveController extends SonataCRUDController {

    public function formCreateCampaignTransferColectiveByPoloAndTypeAction() {
        $form = $this->formCreateTransferColectiveByPoloAndTypeAux();
        return $this->render('DaiquiriAdminBundle:CampaignTransferColective:form_create_campaign_transfer_colective_by_polo_and_type.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    private function formCreateTransferColectiveByPoloAndTypeAux() {
        $form = $this->createFormBuilder(
                        array(), array(), array())
                ->add('polofrom', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'label' => 'Origin',
                    'required' => true
                ))
                ->add('placetypefrom', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\PlaceType',
                    'property' => 'title',
                    'required' => true,
                    'label' => 'Origin Type Place (AirPort | Hotel)'
                ))
                ->add('poloto', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'required' => true,
                    'label' => 'Destination'
                ))
                ->add('placetypeto', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\PlaceType',
                    'property' => 'title',
                    'required' => true,
                    'label' => 'Destination Type Place (AirPort | Hotel)'
                ))
                ->add('campaign', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CampaignTransferColective',
                    'property' => 'title',
                    'required' => true,
                    'label' => 'Campaign'
                ))
                ->add('reverse', 'checkbox', array(
                    'label' => 'Check this if you want asocied also reverse Transfer',
                    'required' => false))
                ->getForm();
        return $form;
    }

    public function createCampaignTransferColectiveByPoloAndTypeAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $form = $this->formCreateTransferColectiveByPoloAndTypeAux();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            //dump($data);die;
            //obtengo todos los places origenes que sean pikuplace de tranfer y sean del polo deseado
            $placesfrom = $em->getRepository('DaiquiriAdminBundle:Place')->findBy(
                    array('ispickupplace_transfer' => true,
                        'polo' => $data['polofrom'],));
            //obtengo todos los places destino que sean pikuplace de tranfer y sean del polo deseado
            $placesto = $em->getRepository('DaiquiriAdminBundle:Place')->findBy(
                    array('ispickupplace_transfer' => true,
                        'polo' => $data['poloto'],));
            $c = $data['campaign'];

            //vvalido que existan places de origin y destino para proceder la operacion
            if (!$placesfrom) {
                $this->addFlash('sonata_flash_info', 'Not Found Origin Place to Create Transfer ');
                return $this->render('DaiquiriAdminBundle:TransferColective:form_create_transfer_colective_by_polo_and_type.html.twig', array(
                            'form' => $form->createView()
                ));
            }
            if (!$placesto) {
                $this->addFlash('sonata_flash_info', 'Not Found Detination Place to Create Transfer');
                return $this->render('DaiquiriAdminBundle:TransferColective:form_create_transfer_colective_by_polo_and_type.html.twig', array(
                            'form' => $form->createView()
                ));
            }
            if (!$c) {
                $this->addFlash('sonata_flash_info', 'Not Campaign Detination Place to Create Transfer ');
                return $this->render('DaiquiriAdminBundle:CampaignTransferColective:form_create_campaign_transfer_colective_by_polo_and_type.html.twig', array(
                            'form' => $form->createView()
                ));
            }
            //filtro de esos cuales tinen el typo de place entrado por parametro
            $origenes = array();
            $destination = array();

            foreach ($placesfrom as $place) {
                if ($place->hasPlaceType($data['placetypefrom'])) {
                    $origenes[] = $place;
                }
            }
            foreach ($placesto as $place) {
                if ($place->hasPlaceType($data['placetypeto'])) {
                    $destination[] = $place;
                }
            }
            //  dump($placesto);die;
            $asocied = array();
            $create_new = array();
            foreach ($origenes as $origin) {
                //dump("0" . $origin);
                foreach ($destination as $destino) {
                    // dump("1" . $destino);
                    if ($origin->getId() != $destino->getId()) {
                        //para cada origen y destino verifico que exista el transfer
                        $transfer = $em->getRepository('DaiquiriAdminBundle:TransferColective')->findOneBy(array(
                            'placefrom' => $origin->getId(),
                            'placeto' => $destino->getId()));
                        if ($transfer) {
                            $transfer->addCampaign($c);
                            $c->addTransfer($transfer);
                            $em->persist($transfer);
                            $em->persist($c);
                            $asocied[] = $transfer;
                        } else {
                            $transfer = new \Daiquiri\AdminBundle\Entity\TransferColective();
                            $transfer->setAvailable(true);
                            $transfer->setPayonline(true);
                            $transfer->setPlacefrom($origin);
                            $transfer->setPlaceto($destino);
                            $transfer->setPricepax($c->getPricepax());
                            $transfer->addCampaign($c);
                            $c->addTransfer($transfer);
                            $create_new[] = $transfer;
                            $em->persist($transfer);
                            $em->persist($c);
                        }
                        if ($data['reverse']) {
                            $transfer = $em->getRepository('DaiquiriAdminBundle:TransferColective')->findOneBy(array(
                                'placefrom' => $destino->getId(),
                                'placeto' => $origin->getId()));
                            if ($transfer) {
                                $transfer->addCampaign($c);
                                $c->addTransfer($transfer);
                                $em->persist($transfer);
                                $em->persist($c);
                                $asocied[] = $transfer;
                            } else {
                                $transfer = new \Daiquiri\AdminBundle\Entity\TransferColective();
                                $transfer->setAvailable(true);
                                $transfer->setPayonline(true);
                                $transfer->setPlacefrom($destino);
                                $transfer->setPlaceto($origin);
                                $$transfer->setPricepax($c->getPricepax());
                                $transfer->addCampaign($c);
                                $c->addTransfer($transfer);
                                $create_new[] = $transfer;
                                $em->persist($transfer);
                                $em->persist($c);
                            }
                        }
                        $em->flush();
                    }
                }
            }
            // die;
            $this->addFlash('sonata_flash_success', 'Create ' . count($create_new) . ' item successfully.');
            return $this->render('DaiquiriAdminBundle:CampaignTransferColective:form_create_campaign_transfer_colective_by_polo_and_type.html.twig', array(
                        'new' => $create_new,
                        'asocied' => $asocied,
                        'form' => $form->createView()
            ));
        }
        $this->addFlash('sonata_flash_error The data is not valid please check this.');
        return $this->render('DaiquiriAdminBundle:CampaignTransferColective:form_create_campaign_transfer_colective_by_polo_and_type.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}
