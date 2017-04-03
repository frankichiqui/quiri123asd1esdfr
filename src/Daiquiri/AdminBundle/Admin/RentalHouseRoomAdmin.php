<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class RentalHouseRoomAdmin extends AbstractAdmin {

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-rental-house-room-availability', $this->getRouterIdParameter() . '/rental-house-availability');
        $collection->add('create-availability-for-rental-house-room', 'create-availability-for-rental-house-room');
        $collection->add('addtocart', 'add-to-cart');
             
       
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Title Room'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Room Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->end()
                ->with("Images")
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('price', 'money', array('label' => 'Price By Night', 'currency' => 'usd'))
                ->end()
                
                ->with("Facilities", array('class' => 'col-md-4'))
                ->add('rental_house_room_facilities', null, array('by_reference' => false))
                ->end()
                ->end()
                ->with("Max Opcupations", array('class' => 'col-md-4'))
                ->add('rental_house_room_ocupations', null, array('by_reference' => false, 'multiple' => true))
                ->end()
              ->with('Tags')
                ->add('tags', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Tag',
                    'property' => 'title',
                    'multiple' => true,
                    'by_reference' => false
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
                ->add('title', null, array('label' => 'Room Title'))

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Room'))
                ->add('rental_house_room_ocupations', null, array('label' => 'Max Ocp'))
                ->add('rental_house')
                ->add('payonline', null, array('editable' => true))
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Medical Service Description'
                    )
                ))
                ->add('gallery')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                       
                        'availability' => array(
                            'template' => 'DaiquiriAdminBundle:RentalHouseRoomAvailability:list_action_ental_house_room_availability.html.twig'
                        )
                    )
                ))
        ;
    }

    public function prePersist($houseroom) {
        $this->preUpdate($houseroom);
    }

    public function preUpdate($houseroom) {
        $houseroom->setRentalHouseRoomAvailabilities($houseroom->getRentalHouseRoomAvailabilities());

        //$houseroom->setRentalHouseRoom($houseroom->getRentalHouseRoomAvailabilities());
    }


    public $supportsPreviewMode = true;

}
