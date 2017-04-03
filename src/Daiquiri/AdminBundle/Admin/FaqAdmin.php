<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FaqAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->add('title', 'text', array('label' => 'Faq Title'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Faq Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('priority')
                ->add('vote', null, array('label' => 'Votes'))
                ->end()
                ->with('Locale Block')
                ->add('locale', 'language', array(
                    'preferred_choices' => array('en', 'es', 'it')
                ))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Faq Title'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('title', 'FAQ')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'FAQ Description'
                    )
                ))
                ->add('priority', null, array('label' => 'Priority', 'editable' => true))
                ->add('vote', null, array('label' => 'Votes'))
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
