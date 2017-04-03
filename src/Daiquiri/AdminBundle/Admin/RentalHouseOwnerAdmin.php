<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RentalHouseOwnerAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with('Personal', array('class' => 'col-md-4'))
                ->add('name', 'text', array('label' => 'Name', 'required' => true))
                ->add('lastname', 'text', array('label' => 'Lastname', 'required' => false))
                ->add('email', 'text', array('label' => 'Email', 'required' => false))
                ->end()
                ->with('Location', array('class' => 'col-md-4'))
                ->add('phone1', 'text', array('label' => 'Phone 1', 'required' => true))
                ->add('phone2', 'text', array('label' => 'Phone 2', 'required' => false))
                ->add('address', 'text', array('label' => 'address', 'required' => true))
                ->end()
                ->with('Picture')
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
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
                ->add('name', null, array('label' => 'Driver Title'))
                ->add('lastname', null, array('label' => 'Driver Title'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('name', null, array('editable' => true))
                ->add('lastname', null, array('editable' => true))
                ->add('phone1', null, array('editable' => true))
                ->add('email', null, array('editable' => true))
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
