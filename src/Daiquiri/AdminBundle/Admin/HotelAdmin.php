<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class HotelAdmin extends AbstractAdmin {

    public $routeitem = 'form-ocupation-searcher';

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-set-price', $this->getRouterIdParameter() . '/form-set-price');



        $collection->add('set-price', $this->getRouterIdParameter() . '/set-price', array('expose' => true));
        $collection->add('form-ocupation', $this->getRouterIdParameter() . '/ocupation');
        $collection->add('create-ocupation-for-room', 'create-ocupation-for-room');
        $collection->add('form-ocupation-searcher', $this->getRouterIdParameter() . '/form-ocupation-searcher');
        $collection->add('find-ocupation-searcher', $this->getRouterIdParameter() . '/find-ocupation-searcher');
        
        $collection->add('add-to-cart', $this->getRouterIdParameter() . '/add-to-cart');
        $collection->add('form-hotel-availability', $this->getRouterIdParameter() . '/form-hotel-availability');
        $collection->add('set-hotel-room-availability', '{room}/{date}/set-hotel-room-availability');
        $collection->add('set-hotel-room-availability-range', '{room}/{startdate}/{enddate}/set-hotel-room-availability-range');
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Hotel Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Hotel Description',
                    'format' => 'richhtml'
                ))
                ->end()
                ->with('Contact')
                ->add('address', 'text', array('label' => 'Hotel Address'))
                ->add('phone', 'text', array('label' => 'Hotel Phone Number'))
                ->add('email', 'email', array('label' => 'Hotel Email'))
                ->add('website', 'url', array('label' => 'Hotel Website'))
                ->add('hotel_sales_agents', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\HotelSalesAgent',
                    'property' => 'title',
                    'multiple' => true
                ))
                ->end()
                ->with('Clasification')
                ->add('hotelType', 'sonata_type_model', array('property' => 'title', 'class' => 'Daiquiri\AdminBundle\Entity\HotelType'))
                ->add('chain', 'sonata_type_model', array('property' => 'title', 'class' => 'Daiquiri\AdminBundle\Entity\Chain'))
                ->add('stars', 'choice', array('label' => 'Stars',
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                        7 => '7'
            )))
                ->add('allowInfant')
                ->end()
                ->with('Seasons & Diets')
                ->add('ai', null, array('label' => 'AI Hotel'))
                ->add('mountC', 'money', array('label' => 'Plus For Diet MP( Per pax/nigth)', 'currency' => 'USD'))
                ->add('mountCc', 'money', array('label' => 'Plus For Diet FP( Per pax/nigth)', 'currency' => 'USD'))
                ->add('seasons', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Season',
                    'multiple' => true
                ))
                ->add('suplements', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Suplement',
                    'property' => 'title',
                    'label' => 'Hotel Suplements',
                    'multiple' => true
                ))
                ->end()
                ->with('Facilities')
                ->add('hotel_facilitys', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\HotelFacility',
                    'property' => 'title',
                    'label' => 'Hotel Facilities',
                    'multiple' => true
                ))
                ->end()
                ->with('Rooms')
                ->add('rooms', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Room',
                    'property' => 'title',
                    'multiple' => true
                ))
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
                ->with('Place Block', array('class' => 'col-md-6'))
                ->add('province', 'sonata_type_model', array('property' => 'title', 'class' => 'Daiquiri\AdminBundle\Entity\Province'))
                ->add('polo', 'sonata_type_model', array('property' => 'title', 'class' => 'Daiquiri\AdminBundle\Entity\Polo'))
                ->add('zone', 'sonata_type_model', array('property' => 'title', 'class' => 'Daiquiri\AdminBundle\Entity\Zone'))
                ->add('placetypes', null, array('label' => 'Place Type'))
                ->end()
                ->with('Google Location', array('class' => 'col-md-6'))
                ->add('latitude', null, array('label' => 'Latitude', 'required' => false))
                ->add('longitude', null, array('label' => 'Longitude', 'required' => false))
                ->end()
                ->with('Product Property')
                ->add('productIncrement', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ProductIncrement',
                    'label' => 'Increment',
                ))
                ->add('priority')
                ->add('available')
                
                ->add('reviewAvailable')
                
                ->end()
                ->with('Terms & Conditions', array('class' => 'col-md-4'))
                ->add('term_condition_hotel', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\TermConditionProduct',
                    'property' => 'title'
                ))
                ->end()
                ->with('Cancelations Politics', array('class' => 'col-md-4'))
                ->add('cancelation_hotel', 'sonata_type_model', array(
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
                    'format' => 'richhtml'
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
                ->add('title', null, array('label' => 'Hotel Name'))
                ->add('polo', null, array('label' => 'Polo Name'))
                ->add('suplements', null, array('label' => 'Suplements'))
                ->add('priority', null, array(), 'sonata_type_filter_number')
                ->add('available')
                ->add('payonline')
                ->add('allowInfant')
                ->add('ai', null, array('label' => 'AI Hotel'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => ' Title'))
                ->add('hotelType', 'text', array('label' => ' Type'))
                ->add('rooms')
                ->add('availableDiteforList')
                ->add('hasGoogleLocation', 'boolean', array('label' => 'Glocation'))
                ->add('ispickupplacefor', 'text', array('label' => 'Pick Up Place'))
                // ->add('polo')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        'form-set-hotel-price' => array(
                            'template' => 'DaiquiriAdminBundle:Hotel:hotel_price_bottom.html.twig'
                        ),
                        'ocupation' => array(
                            'template' => 'DaiquiriAdminBundle:Room:list_action_ocupation.html.twig'
                        ),
                        
                        'form-ocupation-item' => array(
                            'template' => 'DaiquiriReservationBundle:Default:book.html.twig'
                        ),
                        'form-rooms-availability' => array(
                            'template' => 'DaiquiriAdminBundle:Hotel:hotel_availability_bottom.html.twig'
                        ),
                    )
                ))
        ;
    }

    public function prePersist($hotel) {
        $this->preUpdate($hotel);
    }

    public function preUpdate($hotel) {
        $hotel->setSeasons($hotel->getSeasons());
        $hotel->setHotelFacilities($hotel->getHotelFacilitys());
        $hotel->setHotelSalesAgents($hotel->getHotelSalesAgents());
        $hotel->setRooms($hotel->getRooms());
        $hotel->setSuplements($hotel->getSuplements());
    }

    public $supportsPreviewMode = true;

}
