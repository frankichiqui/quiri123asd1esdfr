<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CampaignExcursionColectiveAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with("General Data", array('class' => 'col-md-12'))
                ->add('title', null, array('label' => 'Title'))
                ->add('subtitle', null, array('label' => 'Sub Title'))
                ->add('caption', null, array('label' => 'Caption Bottom'))
                ->add('excursion', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ExcursionColective',
                    'property' => 'title',
                    'btn_add' => false
                ))
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
                    'by_reference' => false
                ))
                ->add('block', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Block',
                    'property' => 'title',
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
                ->with("Prices", array('class' => 'col-md-3'))
                ->add('adultdiscount', 'number', array('label' => 'Adult Discount', 'attr' => array(
                        'empty_data' => 0,
                        'class' => ' form-control')))
                
                ->add('kiddiscount', 'number', array('label' => 'Kid Discount ', 'attr' => array(
                        'empty_data' => 0,
                        'class' => ' form-control')))
             
                ->end()
                ->with("Show in", array('class' => 'col-md-3'))
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
                ->with("To booking between Dates", array('class' => 'col-md-3'))
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
                ->with("Reservation Dates", array('class' => 'col-md-3'))
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
                    'label' => 'Airline Description',
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
                    'preferred_choices' => array('en', 'es', 'it' )
                ))
                ->end()


        ;
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
                ->add('excursion')
                ->add('block')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

//    public function prePersist($airline) {
//        $this->preUpdate($airline);
//    }
//
//    public function preUpdate($airline) {
//        $airline->setFlights($airline->getFlights());
//    }

    public $supportsPreviewMode = true;

}
