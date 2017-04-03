<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CurrencyAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'currency', array(
                    'preferred_choices' => array('USD', 'EUR', 'RUB', 'GBP'),
                    'label' => 'Currency Name',
                    'required' => true
                ))
                ->add('change', 'number', array('label' => 'Value to US Dollar',
                    'required' => true, 'precision' => 4))
                ->add('nomenclator', null, array('label' => 'Symbol',
                    'required' => false))
                ->add('favicon', 'text', array('label' => 'Fav Icon',
                    'required' => true))
                ->add('code', 'text', array('label' => 'Code',
                    'required' => true))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Currency Name'))
                ->add('change', null, array('label' => 'Value to dollar'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title', 'string')
                ->add('change', null, array('editable' => true))
                ->add('nomenclator', 'string', array('editable' => true) )
                ->add('favicon', 'string', array('editable' => true))
                ->add('code', 'string', array('editable' => true))
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
