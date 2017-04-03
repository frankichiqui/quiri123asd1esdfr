<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Daiquiri\AdminBundle\Entity\Season;

/**
 * TransferColective controller.
 *
 */
class SeasonController extends SonataCRUDController {

    public function formCreateSeasonForAllHotelByChainAction(Request $request) {
        $form = $this->formCreateSeasonForAllHotelByChainAux();
        return $this->render('DaiquiriAdminBundle:Season:form_create_season_for_all_hotel_by_chain.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function createSeasonForAllHotelByChainAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->formCreateSeasonForAllHotelByChainAux();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $create_new = array();
            $existent = array();
            $count = 0;
            $data = $form->getData();
            //validar las fechas
            $startdate = $data['startdate'];
            $enddate = $data['enddate'];
            $hoy = new \DateTime('now');
            //dump($enddate);die;
            if ($startdate < $enddate && $startdate > $hoy) {

                $hotels = $em->getRepository('DaiquiriAdminBundle:Hotel')->findBy(array(
                    'chain' => $data['chain']
                ));
                if ($hotels) {
                    foreach ($hotels as $h) {
                        $season = new Season();
                        $season->setStartdate($startdate);
                        $season->setEnddate($enddate);
                        $season->setTitle($data['title']);
                        $season->setDescription($data['description']);
                        if (!$h->hasSeason($season)) {
                            $h->addSeason($season);
                            $create_new[] = array('hotel' => $h, 'season' => $season);
                            $em->persist($season);
                            $em->persist($h);
                            $count++;
                        } else {
                            $existent[] = array('hotel' => $h, 'season' => $season);
                        }
                    }
                    $em->flush();
                    $this->addFlash('sonata_flash_success', $count . ' New season has ben created');
                    return $this->render('DaiquiriAdminBundle:Season:form_create_season_for_all_hotel_by_chain.html.twig', array(
                                'form' => $form->createView(),
                                'new' => $create_new,
                                'exist' => $existent
                    ));
                } else {
                    $this->addFlash('sonata_flash_info', ' Not Hotels found for ' . $data['chain'] . ' Chain');
                    return $this->render('DaiquiriAdminBundle:Season:form_create_season_for_all_hotel_by_chain.html.twig', array(
                                'form' => $form->createView(),
                    ));
                }
            } else {
                $this->addFlash('sonata_flash_error', 'Start date must be less than the ending date and both higher than this day');
                return $this->render('DaiquiriAdminBundle:Season:form_create_season_for_all_hotel_by_chain.html.twig', array(
                            'form' => $form->createView()
                ));
            }
        }
    }

    private function formCreateSeasonForAllHotelByChainAux() {
        $form = $this->createFormBuilder(
                        array(), array(), array(
                    'action' => $this->admin->generateUrl('create-season-for-all-hotel-by-chain'),
                    'method' => 'POST'))
                ->add('chain', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Chain',
                    'property' => 'title',
                    'label' => 'Chain',
                    'required' => true
                ))
                ->add('title', 'text', array('label' => 'Season Name', 'attr' => array('class' => 'form-control')))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Season Description',
                    'format' => 'richhtml'
                ))
                ->add('startdate', 'sonata_type_date_picker', array('label' => 'Start Date', 'attr' => array('class' => 'form-control')))
                ->add('enddate', 'sonata_type_date_picker', array('label' => 'End Date', 'attr' => array('class' => 'form-control')))
                ->getForm();

        return $form;
    }

}
