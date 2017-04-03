<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ContactAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('email', 'email', array('label' => 'Email'))
                ->add('name', 'text', array('label' => 'Name'))
                //->add('lastName', 'text', array('label' => 'Last Name'))
                ->add('contactCause', null, array('label' => 'Contact Cause'))
                ->add('message', 'sonata_simple_formatter_type', array('format' => 'richhtml'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('email')
                ->add('name')
                //->add('lastName')
                ->add('message')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('email', 'email', array('label' => 'Email'))
                ->add('name', 'text', array('label' => 'Name'))
                //->add('lastName', 'text', array('label' => 'Last Name'))
                ->add('contactCause', null, array('label' => 'Contact Cause'))
                ->add('message', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Message'
                    )
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
