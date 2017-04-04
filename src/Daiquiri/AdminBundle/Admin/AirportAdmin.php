<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AirportAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->add('title', 'text', array('label' => 'Airport Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Airport Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('phone')
                ->add('address')
                ->add('flights', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Flight',
                    'property' => 'title',
                    'label' => 'Flights',
                    'multiple' => true,
                    'btn_add' => false
                ))
                ->add('province', null, array('label' => 'Province'))
                ->add('polo', null, array('label' => 'Destination'))
                ->end()
                ->with('Google Location')
                ->add('latitude', 'text', array('label' => 'Latitude', 'required' => false))
                ->add('longitude', 'text', array('label' => 'Longitude', 'required' => false))
                ->end()
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
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
                ->add('title', null, array('label' => 'Airport'))
                ->add('flights', null, array('multiple' => true, 'label' => 'Flights'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title')
                ->add('phone')
                ->add('address')
                ->add('polo')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Airport Description'
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

    public function prePersist($airport) {
        $this->preUpdate($airport);
    }

    public function preUpdate($airport) {
        $airport->setFlihgts($airport->getFlights());
    }

    public $supportsPreviewMode = true;

}
