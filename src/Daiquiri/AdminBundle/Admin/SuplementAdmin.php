<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SuplementAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Suplement Name'))
                ->add('date', 'sonata_type_date_picker', array('label' => 'Suplement Date'))
                ->add('adultprice', 'money', array('currency' => 'USD', 'label' => 'Adult Price'))
                ->add('kidprice', 'money', array('currency' => 'USD', 'label' => 'Child Price'))
                //->add('hotel')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Suplement Name'))
                ->add('date', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker', 'label' => 'Suplement Date'))
                ->add('adultprice', null, array('label' => 'Adult Price'))
                ->add('kidprice', null, array('label' => 'Child Price'))
                ->add('hotel')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title', null, array('label' => 'Suplement Name'))
                ->add('date', null, array('label' => 'Suplement Date', 'editable' => true))
                ->add('adultprice', null, array('editable' => true, 'label' => 'Adult Price'))
                ->add('kidprice', null, array('editable' => true, 'label' => 'Child Price'))
                ->add('hotel')

        ;
    }

    public $supportsPreviewMode = true;

}
