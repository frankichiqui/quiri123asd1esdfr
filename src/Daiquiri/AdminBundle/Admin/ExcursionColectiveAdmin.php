<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class ExcursionColectiveAdmin extends AbstractAdmin {

    public $routeitem = 'form-excursion-colective-searcher';

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-excursion-colective-searcher', $this->getRouterIdParameter() . '/form-excursion-colective-searcher');
        $collection->add('find-excursion-colective-searcher', $this->getRouterIdParameter() . '/find-excursion-colective-searcher');
        $collection->add('addtocart', 'add-to-cart');

        
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Excursion Exclusive Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Excursion Exclusive Description',
                    'format' => 'richhtml'
                ))
                ->add('duration', null, array('label' => 'Hours Duration'))
                ->end()
                ->with('Excursion Types', array('class' => 'col-md-4'))
                ->add('excursionTypes')
                ->end()
                ->with('Excursion Places', array('class' => 'col-md-4'))
                ->add('places', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'multiple'=>true,
                    'by_reference'=>false,
                ))
                ->end()
                ->with('Departure Destination', array('class' => 'col-md-4'))
                ->add('polofrom', null, array('label' => 'Departure Polo'))
                ->end()
                ->with('Excursion Availables Days', array('class' => 'col-md-6'))
                ->add('sunday')
                ->add('monday')
                ->add('thuesday')
                ->add('wednesday')
                ->add('thursday')
                ->add('friday')
                ->add('saturday')
                ->end()
                ->with('Excursion Colective Block', array('class' => 'col-md-6'))
                ->add('adultprice', 'money', array('currency' => 'USD', 'label' => 'Adult Price'))
                ->add('kidPrice', 'money', array('currency' => 'USD', 'label' => 'Kid Price'))
                ->add('minpax', null, array('label' => 'Minimun Of Pax'))
                ->end()
                ->with('Includes')
                ->add('include', 'sonata_simple_formatter_type', array(
                    'label' => 'The Excursion Include',
                    'format' => 'richhtml'
                ))
                ->add('notinclude', 'sonata_simple_formatter_type', array(
                    'label' => 'The Excursion Not Include',
                    'format' => 'richhtml'
                ))
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
                ->with('Product Property')
                ->add('productIncrement', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ProductIncrement',
                    'label' => 'Increment',
                ))
                ->add('priority')
                ->add('available')
                ->add('payonline')
                ->add('reviewAvailable')
                
                ->end()
                ->with('Terms & Conditions', array('class' => 'col-md-4'))
                ->add('term_condition_product', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\TermConditionProduct',
                    'property' => 'title'
                ))
                ->end()
                ->with('Cancelations Politics', array('class' => 'col-md-4'))
                ->add('cancelation_product', 'sonata_type_model', array(
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
                ->add('title', null, array('label' => 'Excursion Name'))
                ->add('places', null, array('label' => 'Place Name'))
                ->add('polofrom', null, array('label' => 'Province From'))
                ->add('excursionTypes', null, array('label' => 'Excursion Type', 'multiple' => true))
                ->add('adultprice', null, array(), 'sonata_type_filter_number')
                ->add('kidPrice', null, array('label' => 'Childrens Price'), 'sonata_type_filter_number')
                ->add('duration', null, array('label' => 'Hours Duration'), 'sonata_type_filter_number')
                ->add('priority', null, array(), 'sonata_type_filter_number')
                ->add('available')
                ->add('payonline')
                ->add('sunday')
                ->add('monday')
                ->add('thuesday')
                ->add('wednesday')
                ->add('thursday')
                ->add('friday')
                ->add('saturday')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Excursion Colective'))
                ->add('duration', null, array('label' => 'Hours Duration', 'editable' => true))
                ->add('adultprice', null, array('editable' => true))
                ->add('kidPrice', null, array('editable' => true, 'label' => 'Childrens Price'))
                ->add('minpax', null, array('label' => 'Min. Paxs', 'editable' => true))
                ->add('places', null, array('editable' => true))
                ->add('polofrom', null, array('label' => 'Province From', 'editable' => true))
                ->add('sunday', null, array('label' => 'Sun', 'editable' => true))
                ->add('monday', null, array('label' => 'Mon', 'editable' => true))
                ->add('thuesday', null, array('label' => 'Thu', 'editable' => true))
                ->add('wednesday', null, array('label' => 'Wed', 'editable' => true))
                ->add('thursday', null, array('label' => 'Thu', 'editable' => true))
                ->add('friday', null, array('label' => 'Fri', 'editable' => true))
                ->add('saturday', null, array('label' => 'Sat', 'editable' => true))
                ->add('available', null, array('editable' => true))
                ->add('payonline', null, array('editable' => true))
                ->add('campaigns', null, array('editable' => true))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        
                        'apply' => array(
                            'template' => 'DaiquiriReservationBundle:Excursion:request_buttom.html.twig'
                        ),
                        'form-excursion-colective-item' => array(
                            'template' => 'DaiquiriReservationBundle:Default:book.html.twig'
                        ),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;

}
