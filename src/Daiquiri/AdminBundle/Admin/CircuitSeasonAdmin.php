<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CircuitSeasonAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Circuit Season Name'))
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
                ->with('Prices in Sgl', array('class' => 'col-md-6'))
                ->add('adultPrice', 'money', array('currency' => 'USD', 'label' => 'Aldult Price'))
                ->add('kidPrice', 'money', array('currency' => 'USD', 'label' => 'Kid Price'))
                ->end()
                ->with('Prices in Dbl', array('class' => 'col-md-6'))
                ->add('kidPriceDoble', 'money', array('currency' => 'USD', 'label' => 'Kid Price dobble'))
                ->add('adultPriceDoble', 'money', array('currency' => 'USD', 'label' => 'Aldult Price in dobble'))
                ->end()

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Circuit Season Name'))
                ->add('date', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('circuit')
                ->add('adultPrice', null, array(), 'sonata_type_filter_number')
                ->add('kidPrice', null, array('label' => 'Childrens Price'), 'sonata_type_filter_number')


        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('circuit')
                ->addIdentifier('title')
                ->add('adultPriceDoble', null, array('label' => 'adult PriceDoble', 'editable' => true))
                ->add('kidPriceDoble', null, array('label' => 'kid PriceDoble', 'editable' => true))
                ->add('adultPrice', null, array('label' => 'adult Price', 'editable' => true))
                ->add('kidPrice', null, array('label' => 'kid Price', 'editable' => true))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;

    public function prePersist($object) {
        $object->setTitle(strtoupper($object->getTitle()) . ' ' . $object->getStartdate()->format("M j, Y") . " - " . $object->getEnddate()->format("M j, Y"));
    }

}
