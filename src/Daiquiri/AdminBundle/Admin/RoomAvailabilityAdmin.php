<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RoomAvailabilityAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('room')
                ->add('date', 'date', array('label' => 'Date'))
               

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('date', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('room', null, array('label' => 'Room Name'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {

        $listMapper     
                ->add('room.hotel', null, array('label' => 'Hotel'))
                ->add('room', null, array('label' => 'Room'))
                ->add('date', null, array(
                    'format' => 'M j, Y',
                ))
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
