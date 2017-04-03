<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ReviewProductAdmin extends AbstractAdmin {

    public function configure() {
        
        $this->setTemplate("base_list_field", "SonataAdminBundle:CRUD:base_list_flat_field.html.twig");
    }

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->add('title')
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Review Content',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('product')
                ->add('show')
                ->add('votes', 'choice', array('choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        5 => 5
            )))

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('votes')
                ->add('createdAt')
                ->add('product')
                ->add('show')

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                // ->add('user', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                 ->addIdentifier('title')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Review Content'
                    )
                ))
                ->add('votes', null, array('editable' => true))
                ->add('show', null, array('editable' => true))
                ->add('createdAt', 'datetime', array('editable' => true))
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
