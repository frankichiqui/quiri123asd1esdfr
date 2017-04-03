<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class HotelSalesAgentAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                 ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->end()
                ->with("Personal", array('class' => 'col-md-6'))
                
                ->add('title', 'text', array('label' => 'Title'))
                ->add('name', 'text', array('label' => 'Name'))
                ->add('lastname', 'text', array('label' => 'Lastname'))
                ->end()
                ->with("Location", array('class' => 'col-md-6'))                
                ->add('email', 'email', array('label' => 'Email'))
                ->add('phone1', 'text', array('label' => 'Phone', 'required' => false))
                ->add('phone2', 'text', array('label' => 'Phone 2', 'required' => false))
                ->end()
               
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Hotel Sales Agent Title'))
                ->add('name', null, array('label' => 'Name'))
                ->add('lastname', null, array('label' => 'Lastname'))
                ->add('email', null, array('label' => 'Email'))
                ->add('phone1', null, array('label' => 'Phone 1'))
                ->add('hotel', null, array('label' => 'Hotel'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', null, array('label' => 'Hotel Sales Agent Title'))
                ->add('name', null, array('editable' => true))
                ->add('lastname', null, array('editable' => true))
                ->add('phone1', null, array('editable' => true))
                ->add('phone2', null, array('editable' => true))
                ->add('email', null, array('editable' => true))
                ->add('hotel')
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
