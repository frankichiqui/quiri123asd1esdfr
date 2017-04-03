<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CircuitAvailabilityAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('date', 'sonata_type_date_picker')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('date', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('circuits', null, array('label' => 'Circuit Name', 'multiple' => true))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('circuits', null, array('label' => 'Circuit'))
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
