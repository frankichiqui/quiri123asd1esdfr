<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class RoomAdmin extends AbstractAdmin {

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-ocupation', $this->getRouterIdParameter() . '/ocupation');
        $collection->add('create-ocupation-for-room', 'create-ocupation-for-room');
        $collection->add('form-availability', $this->getRouterIdParameter() . '/availability');
        $collection->add('create-availability-for-room', 'create-availability-for-room');

        
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Room Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Room Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('room_facilities', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility',
                    'label' => 'Rooms Facilities',
                    'multiple' => true
                ))
                ->add('numberofbeds', 'choice', array('choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4
            )))
               ->add('area', 'number', array('label' => 'Area(m^2)'))

                /* ->add('room_availabilitys', 'sonata_type_model', array(
                  'class' => 'Daiquiri\AdminBundle\Entity\RoomAvailability',
                  'label' => 'Rooms Availabilities',
                  'multiple' => true

                  ))
                  ->add('ocupations', 'sonata_type_model', array(
                  'class' => 'Daiquiri\AdminBundle\Entity\Ocupation',
                  'label' => 'Room Ocupation',
                  'multiple' => true
                  )) */
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
                ->add('campaigns')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Room Name'))
                ->add('hotel', null, array('label' => 'Hotel Name'))
                ->add('room_facilities', null, array('label' => 'Rooms Facilities', 'multiple' => true))
                //->add('room_availabilitys', 'doctrine_orm_model_autocomplete', array('label' => 'Rooms Availabilities'), null, array('multiple' => true))
                ->add('ocupations', null, array('label' => 'Rooms Ocupations', 'multiple' => true))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', null, array('label' => 'Room Name'))
                ->add('hotel')
                ->add('ocupations')
                ->add('getFromprice')
                ->add('room_facilities', null, array('label' => 'Facilities'))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        'ocupation' => array(
                            'template' => 'DaiquiriAdminBundle:Room:list_action_ocupation.html.twig'
                        ),
                        'availability' => array(
                            'template' => 'DaiquiriAdminBundle:RoomAvailability:list_action_availability.html.twig'
                        ),
                      
                    )
                ))
        ;
    }

    public function prePersist($room) {
        $this->preUpdate($room);
    }

    public function preUpdate($room) {
        $room->setRoomAvailabilities($room->getRoomAvailabilitys());
        $room->setOcupations($room->getOcupations());
    }

    public $supportsPreviewMode = true;

}
