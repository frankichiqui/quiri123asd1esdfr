<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RentalHouseRoomOcupationAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('adult', 'choice', array('label' => 'Adults', 'choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4
            )))
                ->add('kid', 'choice', array('label' => 'Kids', 'choices' => array(
                        0 => 0,
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4
            )))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('kid', null, array('label' => 'Kids Number'))
                ->add('adult', null, array('label' => 'Adult Number'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('kid', null, array('editable' => true))
                ->add('adult', null, array('editable' => true))
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
