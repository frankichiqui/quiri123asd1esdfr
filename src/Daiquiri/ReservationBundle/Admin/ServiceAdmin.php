<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ServiceAdmin extends AbstractAdmin {

    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) {

        $collection->add('pax-and-payment', 'pax-and-payment');
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('servicepaxs', 'sonata_type_collection', array(
                    'by_reference' => false,
                    'type_options' => array(
                        'delete' => false,
                    )
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ))
                ->add('confirmationcode', null, array('label' => 'Confirm Code', 'required' => false))
                ->add('servicemanagementstatus', 'sonata_type_model', array(
                    'class' => 'Daiquiri\ReservationBundle\Entity\ServiceManagementStatus',
                    'property' => 'status',
                    'label' => 'ManagmentStatus',
                    'btn_add' => false,
                    'required' => true,
                ))



        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('confirmationcode', null, array('label' => 'Confirmacion'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('id')
                ->add('confirmationcode', null, array('editable' => true))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    public function prePersist($service) {
        $this->preUpdate($service);
    }

    public function preUpdate($service) {
        $service->setServicepaxs($service->getServicepaxs());
    }

    public $supportsPreviewMode = true;

}
