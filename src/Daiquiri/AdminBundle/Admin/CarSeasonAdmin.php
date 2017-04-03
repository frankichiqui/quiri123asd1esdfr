<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CarSeasonAdmin extends AbstractAdmin {

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
                ->add('price', 'money', array('currency' => 'USD', 'label' => 'Price per day'))
                ->end()

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Circuit Season Name'))
                ->add('startdate', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('enddate', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('car')
                ->add('price', null, array(), 'sonata_type_filter_number')



        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('car')
                ->addIdentifier('title')
                ->add('startdate')
                ->add('enddate')
                ->add('price', null, array('label' => 'Childrens Price'))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;

}
