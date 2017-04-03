<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OcupationAdmin extends AbstractAdmin {
    

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('adults', 'choice', array(
                    'choices' => array(
                        0 => '0',
                        1 => '1',
                        2 => '2',
                        3 => '3'
            )))
                ->add('kids', 'choice', array(
                    'choices' => array(
                        0 => '0',
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4'
            )))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Ocupation Name'))
                ->add('adults', 'doctrine_orm_choice', array(
                    'label' => 'Adults'), 'choice', array(
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
            )))
                ->add('kids', 'doctrine_orm_choice', array(
                    'label' => 'Kids'), 'choice', array(
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
            )))
            ->add('room', null, array('label' => 'Room'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('room.hotel', null, array('label' => 'Hotel'))
                ->addIdentifier('room')
                ->add('adults', 'choice', array(
                    'editable' => true,
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
            )))
                ->add('kids', 'choice', array(
                    'editable' => true,
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
            )))
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
