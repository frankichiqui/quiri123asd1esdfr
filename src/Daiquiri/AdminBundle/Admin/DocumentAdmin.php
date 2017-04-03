<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DocumentAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Required Document'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Required Document Description',
                    'format' => 'richhtml',
                    'required' => true
                ))
                ->end()
                ->with('Locale Block')
                ->add('locale', 'language', array(
                    'preferred_choices' => array('en', 'es', 'it' )
                ))
                ->end()

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Required Document'))
                ->add('products', null, array('label' => 'Product Name', 'multiple' => true))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title', 'text', array('label' => 'Required Document'))
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Required Document Description'
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
