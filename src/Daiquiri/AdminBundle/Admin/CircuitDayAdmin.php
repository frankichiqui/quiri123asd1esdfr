<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CircuitDayAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('day')
                ->add('title', 'text', array('label' => 'Circuit Day Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Circuit Day Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('places', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'multiple' => true,
                    'by_reference' => false
                ))
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                
                ->add('include', 'sonata_simple_formatter_type', array(
                    'label' => 'Include',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('notinclude', 'sonata_simple_formatter_type', array(
                    'label' => 'Not Include',
                    'format' => 'richhtml',
                    'required' => false
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
                ->add('title', null, array('label' => 'Circuit Day Title'))
                ->add('day', 'doctrine_orm_datetime_range', array('label' => 'Number of Day', 'field_type' => 'sonata_type_datetime_range_picker'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title')
                ->add('day')
                ->add('circuit')
                ->add('places')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Circuit Day Description'
                    )
                ))
                ->add('gallery')
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
