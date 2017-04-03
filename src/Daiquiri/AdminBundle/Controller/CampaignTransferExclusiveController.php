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
class CampaignTransferExclusiveController extends SonataCRUDController {

    public function formCreateCampaignTransferExclusiveByPoloAndTypeAction() {
        $form = $this->formCreateTransferExclusiveByPoloAndTypeAux();
        return $this->render('DaiquiriAdminBundle:CampaignTransferExclusive:form_create_campaign_transfer_exclusive_by_polo_and_type.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    private function formCreateTransferExclusiveByPoloAndTypeAux() {
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
                    'class' => 'Daiquiri\AdminBundle\Entity\CampaignTransferExclusive',
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

    public function createCampaignTransferExclusiveByPoloAndTypeAction() {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $form = $this->formCreateTransferExclusiveByPoloAndTypeAux();
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
                return $this->render('DaiquiriAdminBundle:TransferExclusive:form_create_transfer_exclusive_by_polo_and_type.html.twig', array(
                            'form' => $form->createView()
                ));
            }
            if (!$placesto) {
                $this->addFlash('sonata_flash_info', 'Not Found Detination Place to Create Transfer ');
                return $this->render('DaiquiriAdminBundle:TransferExclusive:form_create_transfer_exclusive_by_polo_and_type.html.twig', array(
                            'form' => $form->createView()
                ));
            }
            if (!$c) {
                $this->addFlash('sonata_flash_info', 'Not Found Detination Place to Create Transfer ');
                return $this->render('DaiquiriAdminBundle:TransferExclusive:form_create_transfer_exclusive_by_polo_and_type.html.twig', array(
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
                        $transfer = $em->getRepository('DaiquiriAdminBundle:TransferExclusive')->findOneBy(array(
                            'placefrom' => $origin->getId(),
                            'placeto' => $destino->getId()));
                        if ($transfer) {
                            $transfer->addCampaign($c);
                            $c->addTransfer($transfer);
                            $em->persist($transfer);
                            $em->persist($c);
                            $asocied[] = $transfer;
                        } else {
                            $transfer = new \Daiquiri\AdminBundle\Entity\TransferExclusive();
                            $transfer->setAvailable(true);
                            $transfer->setPayonline(true);
                            $transfer->setPlacefrom($origin);
                            $transfer->setPlaceto($destino);
                            $transfer->setPrice0102($c->getPrice0102());
                            $transfer->setPrice0304($c->getPrice0304());
                            $transfer->setPrice0507($c->getPrice0507());
                            $transfer->setPrice0812($c->getPrice0812());
                            $transfer->setPrice1319($c->getPrice1319());
                            $transfer->setPrice2030($c->getPrice2030());
                            $transfer->setPrice3140($c->getPrice3140());
                            $transfer->addCampaign($c);
                            $c->addTransfer($transfer);
                            $create_new[] = $transfer;
                            $em->persist($transfer);
                            $em->persist($c);
                        }
                        if ($data['reverse']) {
                            $transfer = $em->getRepository('DaiquiriAdminBundle:TransferExclusive')->findOneBy(array(
                                'placefrom' => $destino->getId(),
                                'placeto' => $origin->getId()));
                            if ($transfer) {
                                $transfer->addCampaign($c);
                                $c->addTransfer($transfer);
                                $em->persist($transfer);
                                $em->persist($c);
                                $asocied[] = $transfer;
                            } else {
                                $transfer = new \Daiquiri\AdminBundle\Entity\TransferExclusive();
                                $transfer->setAvailable(true);
                                $transfer->setPayonline(true);
                                $transfer->setPlacefrom($destino);
                                $transfer->setPlaceto($origin);
                                $transfer->setPrice0102($c->getPrice0102());
                                $transfer->setPrice0304($c->getPrice0304());
                                $transfer->setPrice0507($c->getPrice0507());
                                $transfer->setPrice0812($c->getPrice0812());
                                $transfer->setPrice1319($c->getPrice1319());
                                $transfer->setPrice2030($c->getPrice2030());
                                $transfer->setPrice3140($c->getPrice3140());
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
            return $this->render('DaiquiriAdminBundle:CampaignTransferExclusive:form_create_campaign_transfer_exclusive_by_polo_and_type.html.twig', array(
                        'new' => $create_new,
                        'asocied' => $asocied,
                        'form' => $form->createView()
            ));
        }
        $this->addFlash('sonata_flash_error The data is not valid please check this.');
        return $this->render('DaiquiriAdminBundle:CampaignTransferExclusive:form_create_campaign_transfer_exclusive_by_polo_and_type.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}
