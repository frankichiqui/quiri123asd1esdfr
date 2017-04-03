<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RentalHouseRoomAvailabilityAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('rental_house_room', null, array('label' => 'Rental House Room'))
                ->add('date', 'sonata_type_date_picker', array('label' => 'Date'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper                
                ->add('date', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('rental_house_room', null, array('label' => 'Rental House Room'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper 
                ->add('rental_house_room.rental_house', null, array('label' => 'Rental House'))
                ->add('rental_house_room', null, array('label' => 'Rental House Room'))
                ->add('date', 'date', array(
                    'format' => 'M j, Y',
                    'editable' => true
                ))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array()
                        
                    )))
               
        ;
    }

    public $supportsPreviewMode = true;

}

