<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class RentalHouseAdmin extends AbstractAdmin {

    public $routeitem = 'form-rental-house-room-ocupation-searcher';

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-rental-house-room-ocupation-searcher', $this->getRouterIdParameter() . '/form-rental-house-room-ocupation-searcher');
        $collection->add('find-rental-house-room-ocupation-searcher', $this->getRouterIdParameter() . '/find-rental-house-room-ocupation-searcher');
        $collection->add('addtocart', 'room/add-to-cart');
        $collection->add('rentalhouse-availability', $this->getRouterIdParameter() . '/rentalhouse-availability');
        $collection->add('set-rentalhouse-room-availability', '{room}/{date}/set-rentalhouse-room-availability');


        
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'House Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'House Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('privateRental', null, array('label' => 'FOR RENT COMPLETE '))
                ->add('price', 'number', array('label' => 'Price for RENT COMPLETE ', 'precision' => 2, 'required' => false))
                ->end()
                ->with('Images')
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->end()
                ->with('Google Location', array('class' => 'col-md-4'))
                ->add('latitude', 'text', array('label' => 'Latitude', 'required' => false))
                ->add('longitude', 'text', array('label' => 'Longitude', 'required' => false))
                ->add('zone')
                ->end()
                ->with('Types', array('class' => 'col-md-4'))
                ->add('rental_house_type')
                ->end()
                ->with('Owner Information', array('class' => 'col-md-4'))
                ->add('rental_house_owners', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouseOwner',
                    'property' => 'name',
                    'multiple' => true,
                    'by_reference' => false
                ))
                ->end()
                ->with('Facility House', array('class' => 'col-md-4'))
                ->add('rental_house_facilities', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouseFacility',
                    'property' => 'title',
                    'multiple' => true
                ))
                ->end()
                ->with('Rooms', array('class' => 'col-md-4'))
                ->add('rental_house_rooms', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouseRoom',
                    'property' => 'title',
                    'multiple' => true
                ))
                ->end()
                ->with('Product Property')
                ->add('productIncrement', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ProductIncrement',
                    'label' => 'Increment',
                ))
                ->add('priority')
                ->add('available')
                ->add('payonline')
                
                ->end()
                ->with('Terms & Conditions', array('class' => 'col-md-4'))
                ->add('term_condition_house', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\TermConditionProduct',
                    'property' => 'title'
                ))
                ->end()
                ->with('Cancelations Politics', array('class' => 'col-md-4'))
                ->add('cancelation_house', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CancelationProduct',
                    'property' => 'title'
                ))
                ->end()
                ->with('Required Documents', array('class' => 'col-md-4'))
                ->add('documents', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Document',
                    'property' => 'title',
                    'multiple' => true,
                    'by_reference' => false
                ))
                ->end()
                ->with('Remarks Block')
                ->add('remarks', 'sonata_simple_formatter_type', array(
                    'label' => 'Aditional Remarks',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->end()
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
                ->add('title', null, array('label' => 'House Name'))
                ->add('rental_house_rooms', null, array('label' => 'Rooms'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title')
                ->add('privateRental', null, array('editable' => true))
                ->add('getFromprice')
                ->add('rental_house_type', null, array('label' => 'Type'))
                ->add('rental_house_owners', null, array('label' => 'Owners'))
                ->add('rental_house_rooms', null, array('label' => 'Rooms'))
                ->add('gallery')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        
                        'form-rental-house-room-ocupation-searcher' => array(
                            'template' => 'DaiquiriReservationBundle:Default:book.html.twig'
                        ),
                        'apply' => array(
                            'template' => 'DaiquiriReservationBundle:RentalHouse:request_buttom.html.twig'
                        ),
                        'availability' => array(
                            'template' => 'DaiquiriAdminBundle:RentalHouse:rentalhouse_availability_bottom.html.twig'
                        ),
                    )
                ))
        ;
    }

    public function prePersist($rentalHouse) {
        $this->preUpdate($rentalHouse);
    }

    public function preUpdate($rentalHouse) {
        $rentalHouse->setRentalHouseFacilities($rentalHouse->getRentalHouseFacilities());
        $rentalHouse->setRentalHouseRooms($rentalHouse->getRentalHouseRooms());
        
        //dump($rentalHouse);die;
    }
    
   
    public $supportsPreviewMode = true;

}
