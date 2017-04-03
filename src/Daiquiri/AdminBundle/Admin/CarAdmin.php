<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CarAdmin extends AbstractAdmin {

    public $routeitem = 'form-car-searcher';

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-create-car-availability', $this->getRouterIdParameter() . '/form-create-car-availability');
        $collection->add('set-car-availability', '{car_id}/{date}/set-car-availability');

        $collection->add('form-car-searcher', $this->getRouterIdParameter() . '/form-car-searcher');
        $collection->add('find-into-car-searcher', $this->getRouterIdParameter() . '/find-into-car-searcher');
        $collection->add('addtocart', 'add-to-cart');
        $collection->add('form-car-reservation-service-pax', $this->getRouterIdParameter() . '/form-car-reservation-service-pax');
        $collection->add('create-pax-and-asociate-to-service', $this->getRouterIdParameter() . '/create-pax-and-asociate-to-service');

     
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title')
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Car Description',
                    'format' => 'richhtml'
                ))
                ->add('carCategory')
                ->add('carClass')
                ->add('capacity', 'choice', array('label' => 'Car Capacity',
                    'choices' => array(
                        2 => '2',
                        4 => '4',
                        6 => '6',
                        9 => '9',
                        10 => '10+'
            )))
                ->add('airConditioner')
                ->add('clima', null, array('label' => 'Clima Control'))
                ->add('cdPlayer')
                ->add('radio')
                ->add('transsmission', 'choice', array('label' => 'Transsmission',
                    'choices' => array(
                        0 => 'Automatic',
                        1 => 'Manual'
            )))
                ->add('luggagecapacity')
                ->add('doors', 'choice', array('label' => 'Number of Doors', 'choices' => array(
                        2 => '2',
                        4 => '4'
            )))
                ->add('powerdoorslock', null, array('label' => 'Power Doors Lock'))
                ->add('tilt', null, array('label' => 'Tilt Steering Wheel'))
                ->add('satellite', null, array('label' => 'Satellite Navigation'))
                ->add('powerwindow', null, array('label' => 'Power Windows'))
                ->add('power', 'choice', array('label' => 'Car Power',
                    'choices' => array(
                        0 => 'Diesel',
                        1 => 'Hybrid',
                        2 => 'Electric'
            )))
                ->add('terminalpickup', null, array('label' => 'Terminal Pickup'))
                ->add('shuttlebus', null, array('label' => 'Shuttle Bus to Car'))
                ->add('carseason', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CarSeason',
                    'multiple' => true,
                    'by_reference' => true
                ))
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->end()
                ->with('Drivers Information')
                ->add('drivers', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Driver',
                    'property' => 'title',
                    'multiple' => true,
                    'by_reference' => false
                ))
                ->end()
                ->with('Product Property', array('class' => 'col-md-3'))
                ->add('productIncrement', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ProductIncrement',
                    'label' => 'Increment',
                ))
                ->add('priority')
                ->add('available')
                ->add('payonline')
                ->add('reviewAvailable')
               
                ->end()
                ->with('Terms & Conditions', array('class' => 'col-md-3'))
                ->add('term_condition_product', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\TermConditionProduct',
                    'property' => 'title',
                ))
                ->end()
                ->with('Cancelations Politics', array('class' => 'col-md-3'))
                ->add('cancelation_product', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CancelationProduct',
                    'property' => 'title',
                ))
                ->end()
                ->with('Required Documents', array('class' => 'col-md-3'))
                ->add('documents', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Document',
                    'property' => 'title',
                    'multiple' => true
                ))
                ->end()
                ->with('Remarks Block')
                ->add('remarks', 'sonata_simple_formatter_type', array(
                    'label' => 'Aditional Remarks',
                    'format' => 'richhtml'
                ))
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
                    'preferred_choices' => array('en', 'es', 'it')
                ))
                ->end()



        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Car Name'))
                ->add('luggagecapacity', null, array('label' => 'Luggage Capacity'))
                ->add('drivers', null, array('label' => 'Driver', 'multiple' => true))
                ->add('carClass', null, array('label' => 'Class'))
                ->add('carCategory', null, array('label' => 'Category'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Car'))
                ->add('capacity', null, array('editable' => true))
                ->add('airConditioner', null, array('editable' => true))
                ->add('luggagecapacity', null, array('label' => 'Luggage Capacity'))
                ->add('available', null, array('editable' => true))
                ->add('payonline', null, array('editable' => true))
                ->add('priority', null, array('editable' => true))
                ->add('campaigns')
                ->add('getFromprice')
                ->add('term_condition_product', null, array('label' => 'Terms & Conditions'))
                ->add('gallery')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        'form-create-car-availability-by-date-range' => array(
                            'template' => 'DaiquiriAdminBundle:Car:list_action_car.html.twig'
                        ),
                        
                        'apply' => array(
                            'template' => 'DaiquiriReservationBundle:Car:request_buttom.html.twig'
                        ),
                        'form-car-item' => array(
                            'template' => 'DaiquiriReservationBundle:Default:book.html.twig'
                        )
                    )
                ))
        ;
    }

    public function prePersist($car) {
        $this->preUpdate($car);
    }

    public function preUpdate($car) {
        $car->setCarseason($car->getCarseason());
    }

    public $supportsPreviewMode = true;

}
