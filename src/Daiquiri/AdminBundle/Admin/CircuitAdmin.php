<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class CircuitAdmin extends AbstractAdmin {

    public $routeitem = 'form-circuit-searcher';

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-circuit-searcher', $this->getRouterIdParameter() . '/form-circuit-searcher');

        $collection->add('find-circuit-searcher', $this->getRouterIdParameter() . '/find-circuit-searcher');


        $collection->add('addtocart', 'add-to-cart');

        $collection->add('circuit-availability', $this->getRouterIdParameter() . '/circuit-availability');
        $collection->add('set-circuit-availability', '{circuit}/{date}/ set-circuit-availability');
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Circuit Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Circuit Description',
                    'format' => 'richhtml'
                ))
                ->add('allowkid')
                ->end()
                ->with('Circuit Season & Check Out Dates', array('class' => 'col-md-6'))
                ->add('circuit_days', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CircuitDay',
                    'property' => 'title',
                    'multiple' => true
                ))
                ->add('circuit_seasons', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CircuitSeason',
                    'property' => 'title',
                    'multiple' => true,
                ))
                ->end()
                ->with('Days & Night', array('class' => 'col-md-6'))
                ->add('days')
                ->add('nights')
                ->add('polofrom', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'label' => 'Polo From',
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
                ->with('Product Property')
                ->add('productIncrement', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ProductIncrement',
                    'label' => 'Increment',
                ))
                ->add('provider')
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
                    'format' => 'richhtml',
                    'required' => false
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
                ->add('title', null, array('label' => 'Circuit Name'))
                ->add('circuit_availabilitys', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('circuit_seasons')
                ->add('available')
                ->add('payonline')
                ->add('provider')
                ->add('priority', null, array(), 'sonata_type_filter_number')
                ->add('days', null, array(), 'sonata_type_filter_number')
                ->add('nights', null, array(), 'sonata_type_filter_number')

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Circuit'))
                ->add('circuit_days')
                ->add('days')
                ->add('nights')
                ->add('campaigns')
                ->add('getFromprice')
                ->add('circuit_availabilitys', null, array('label' => 'Check Out Dates'))
                ->add('available', null, array('editable' => true))
                ->add('priority', null, array('editable' => true))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        'form-circuit-availability' => array(
                            'template' => 'DaiquiriAdminBundle:Circuit:circuit_availability_bottom.html.twig'
                        ),
                        'apply' => array(
                            'template' => 'DaiquiriReservationBundle:Circuit:request_buttom.html.twig'
                        ),
                        'form-circuit-item' => array(
                            'template' => 'DaiquiriReservationBundle:Default:book.html.twig'
                        ),
                    )
                ))
        ;
    }

    public function prePersist($circuit) {
        $this->preUpdate($circuit);
    }

    public function preUpdate($circuit) {
       
        $circuit->setCircuitDays($circuit->getCircuitDays());
        $circuit->setCircuitSeasons($circuit->getCircuitSeasons());
       
    }

    public $supportsPreviewMode = true;

}
