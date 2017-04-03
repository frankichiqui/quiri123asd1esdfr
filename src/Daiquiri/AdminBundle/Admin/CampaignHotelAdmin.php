<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CampaignHotelAdmin extends AbstractAdmin {

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-set-price', $this->getRouterIdParameter() . '/form-set-price');
        $collection->add('set-price', $this->getRouterIdParameter() . '/set-price');
    }

    public $showkidelement = false;

    public function configure() {
        $this->setTemplate('list', 'DaiquiriAdminBundle:CampaignHotel:base_list.html.twig');
    }

    /**
     * @param string $name
     * @return null|string
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with("General Data", array('class' => 'col-md-12'))
                ->add('title', null, array('label' => 'Title'))
                ->add('subtitle', null, array('label' => 'Sub Title'))
                ->add('caption', null, array('label' => 'Caption Bottom'))
                 ->add('calification', 'choice', array('choices' => array(
                        1 => '1 Star',
                        2 => '2 Star',
                        3 => '3 Star',
                        4 => '4 Star',
                        5 => '5 Star'
            )))
                ->add('markets', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Market',
                    'property' => 'title',
                    'multiple' => true,
                    'by_reference' => false,
                    'btn_add' => false
                ))
                ->add('block', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Block',
                    'property' => 'title',
                    'btn_add' => false
                ))
                ->add('available', 'choice', array('choices' => array(
                        true => "Yes",
                        false => "No"
            )))
                ->add('priority', 'choice', array('choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                        7 => '7',
                        8 => '8',
                        9 => '9',
                        10 => '10',
                    )
                ))
                ->end()
                ->add('room', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Room',
                    'btn_add' => false
                ))
                ->end()
                ->with("Show in", array('class' => 'col-md-4'))
                ->add("showstartdate", 'sonata_type_date_picker', array(
                    'label' => 'Start Date',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('today'))->format("M j, Y"),
                    'required' => true))
                ->add("showenddate", 'sonata_type_date_picker', array(
                    'label' => 'End Date',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('tomorrow'))->format("M j, Y"),
                    'required' => true))
                ->end()
                ->with("To booking between Dates", array('class' => 'col-md-4'))
                ->add("instartdate", 'sonata_type_date_picker', array(
                    'label' => 'Start Date',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('today'))->format("M j, Y"),
                    'required' => true))
                ->add("inenddate", 'sonata_type_date_picker', array(
                    'label' => 'End Date',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('tomorrow'))->format("M j, Y"),
                    'required' => true))
                ->end()
                ->with("Reservation Dates", array('class' => 'col-md-4'))
                ->add("startdate", 'sonata_type_date_picker', array(
                    'label' => 'Start Date',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('today'))->format("M j, Y"),
                    'required' => true))
                ->add("enddate", 'sonata_type_date_picker', array(
                    'label' => 'End Date',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('tomorrow'))->format("M j, Y"),
                    'required' => true))
                ->end()
                ->with("Description", array('class' => 'col-md-12'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Campaign Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->end()
                ->with('Picture')
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->end()
                ->with('Locale Block')
                ->add('locale', 'language', array(
                    'preferred_choices' => array('en', 'es', 'it')
                ))
                ->end()
        ;

        if ($this->showkidelement) {
            $formMapper
                    ->with('Base Price', array('class' => 'hidden'))
                    ->add('base', 'number', array('label' => 'Base Price ',
                        'empty_data' => 0,
                        'attr' => array(
                            'class' => ' form-control', 'currency' => 'usd')))
                    ->end()
                    ->with('Individual Use', array('class' => 'hidden'))
                    ->add('individual', 'number', array('label' => 'Individual Use ',
                        'empty_data' => 0,
                        'attr' => array(
                            'class' => ' form-control')))
                    ->add('cHindividual', 'choice', array(
                        'label' => 'Type',
                        'empty_data' => 2,
                        'choices' => array(
                            1 => '%',
                            2 => '$'),
                        'attr' => array(
                            'class' => ' form-control')))
                    ->end()
                    ->with('3th Pax Discount', array('class' => 'hidden'))
                    ->add('three', 'number', array('label' => '3th Pax Discount ', 'attr' => array(
                            'class' => ' form-control')))
                    ->add('cHthree', 'choice', array(
                        'label' => 'Type',
                        'empty_data' => 2,
                        'choices' => array(
                            1 => '%',
                            2 => '$'),
                        'attr' => array(
                            'class' => ' form-control')))
                    ->end()
                    ->with('Kid Politic', array('class' => 'hidden'))
                    ->add('kidpolicys', 'sonata_type_collection', array(
                        'by_reference' => false,
                        'type_options' => array(
                            // Prevents the "Delete" option from being displayed
                            'delete' => false,
                            'delete_options' => array(
                                // You may otherwise choose to put the field but hide it
                                'type' => 'hidden',
                                // In that case, you need to fill in the options as well
                                'type_options' => array(
                                    'mapped' => false,
                                    'required' => false,
                                )
                            )
                        )
                            ), array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                    ))
                    ->end();
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('markets', null, array('label' => 'Markets'))
                ->add('available', null, array('label' => 'Visible'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title')
                ->add('priority', null, array(
                    'editable' => true
                ))
                ->add('available', null, array(
                    'editable' => true
                ))
                ->add('markets')
                ->add('room.hotel', null, array('label' => 'Hotel'))
                ->add('room', null, array('label' => 'Room'))
                ->add('block')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        'set price' => array(
                            'template' => 'DaiquiriAdminBundle:CampaignHotel:set_price_bottom.html.twig'
                        ),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;

}
