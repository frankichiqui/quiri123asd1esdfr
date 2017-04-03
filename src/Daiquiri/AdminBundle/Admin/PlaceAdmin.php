<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PlaceAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Place Name'))
                ->add('placetypes', null, array('label' => 'Place Type'))
                ->add('province', null, array('label' => 'Province'))
                ->add('polo', null, array('label' => 'Destination'))
                ->end()
                ->with('Google Location')
                ->add('latitude', 'text', array('label' => 'Latitude', 'required' => false))
                ->add('longitude', 'text', array('label' => 'Longitude', 'required' => false))
                ->end()
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Place Description',
                    'format' => 'richhtml'
                ))
                 ->add('ispickupplace_transfer', null, array('label' => 'Pick Up Place for Transfer'))
                ->add('ispickupplace_car', null, array('label' => 'Pick Up Place for Rent a Car'))
                ->add('ispickupplace_circuit', null, array('label' => 'Pick Up Place for Circuit'))
                ->add('ispickupplace_excursion', null, array('label' => 'Pick Up Place for Excursion'))
                
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
                    'preferred_choices' => array('en', 'es', 'it' )
                ))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Place Name'))
                ->add('polo', null, array('label' => 'Polo Name'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Place Name'))

                ->add('placetypes')
                ->add('latitude', 'text', array('label' => 'Place Latitude','editable'=>true))
                ->add('longitude', 'text', array('label' => 'Place Longitude','Place Latitude','editable'=>true))

                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Place Description'
                    )
                ))
                ->add('ispickupplace_transfer', 'boolean', array('label' => 'PkP TFRS', 'editable' => true))
                ->add('ispickupplace_car', 'boolean', array('label' => 'PkP Car', 'editable' => true))
                ->add('ispickupplace_circuit', 'boolean', array('label' => 'PkP CIR', 'editable' => true))
                ->add('ispickupplace_excursion', 'boolean', array('label' => 'PkP EXC', 'editable' => true))
                ->add('polo')
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
