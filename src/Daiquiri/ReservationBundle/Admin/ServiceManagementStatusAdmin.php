<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ServiceManagementStatusAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('color', 'sonata_type_color_selector', array('label' => 'Color to show', 'required' => true))
                ->add('status', 'text', array('label' => 'Status', 'required' => true))

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                
                ->add('color', null, array('label' => 'Color'))
                ->add('status', null, array('label' => 'Status'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('id')
                ->add('status')
                ->add('color',null, array('editable'=>true  ))
                
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(
                            'template'=>'DaiquiriReservationBundle:ServiceManagementStatus:edit_botton.htm.twig'
                        ),
                        'delete' => array(),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;
    public function prePersist($object) {
        $object->setStatus(strtoupper($object->getStatus()));
    }
    public function preUpdate($object) {
        $object->setStatus(strtoupper($object->getStatus()));
    }

}
