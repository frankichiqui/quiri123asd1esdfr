<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class DriverAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with("Personal",array('class'=>'col-md-4'))
                ->add('title', 'text', array('label' => 'Title'))
                ->add('name', 'text', array('label' => 'Name'))
                ->add('lastname', 'text', array('label' => 'Lastname'))

                ->end()
                
                ->with("Location",array('class'=>'col-md-4'))
                ->add('email', 'email', array('label' => 'Email'))

                ->add('phone1', 'text', array('label' => 'Phone 1'))
                ->add('phone2', 'text', array('label' => 'Phone 2', 'required'=> false))
                
                ->end()
                ->with("Adicional",array('class'=>'col-md-4'))
                ->add('experienceyears', 'number', array('label' => 'Experience'))
                ->add('dateofbirth', 'sonata_type_date_picker', array('label' => 'Date of Birth'))
                ->end()
                
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Driver Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
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
                ->add('title', null, array('label' => 'Driver Title'))
                ->add('experienceyears', null, array('label' => 'Driver Experience( Years)'))
                ->add('dateofbirth', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title')
                ->add('name', null, array('editable' => true))
                ->add('lastname', null, array('editable' => true))
                ->add('phone1', null, array('editable' => true))
                ->add('email', null, array('editable' => true))
                ->add('dateofbirth', 'date', array(
                    'format' => 'M j, Y',
                    'editable' => true
                ))
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Drivers Description'
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
