<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AirlineAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->add('title', 'text', array('label' => 'Airline Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Airline Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('flights', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Flight',
                    'property' => 'title',
                    'label' => 'Flights',
                    'multiple' => true
                ))
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Airline'))
                ->add('flights', null, array('multiple' => true, 'label' => 'Flights'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title')
                ->add('flights')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Airline Description'
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

    public function prePersist($airline) {
        $this->preUpdate($airline);
    }

    public function preUpdate($airline) {
        $airline->setFlights($airline->getFlights());
    }

    public $supportsPreviewMode = true;

}
