<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ServicePaxAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('gender', 'sonata_type_model', array(
                    'class' => 'Daiquiri\ReservationBundle\Entity\Gender',
                    'property' => 'title',
                    'required' => TRUE
                ))
                ->add('name', null, array('label' => 'Name','attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('lastname', null, array('label' => 'Last Name','attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('document', null, array('label' => 'Identification (Pasport/DNI/CI)','attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('birthdate', 'sonata_type_date_picker', array(
                    'label' => 'BirthDate',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->format("M j, Y"),
                    'required' => true))

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('name', null, array('label' => 'Name'))
                ->add('lastname', null, array('label' => 'Last Name'))
                ->add('document', null, array('label' => 'Identification'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('name')
                ->add('lastname')
                ->add('document')
                ->add('birthdate')
                ->add('gender')
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
