<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection as RouteCollection;

class TransferColectiveAdmin extends AbstractAdmin {

    public $routeitem = 'form-transfer-colective-searcher';

    /**
     * @param RouteCollection $collection
     * @return Response|void
     */
    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-create-transfer-colective-by-polo-and-type', 'form-create-transfer-colective-by-polo-and-type');
        $collection->add('create-transfer-colective-by-polo-and-type', 'create-transfer-colective-by-polo-and-type');
        $collection->add('form-transfer-colective-searcher', $this->getRouterIdParameter() . '/form-transfer-searcher');
        $collection->add('find-transfer-colective-searcher', $this->getRouterIdParameter() . '/find-transfer-searcher');
        $collection->add('addtocart', 'add-to-cart');
       
    }

    /**
     * @param string $name
     * @return null|string
     */
    public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'DaiquiriAdminBundle:TransferColective:transfer_colective_base_list.html.twig';
                break;
            default:
                return parent::getTemplate($name); // TODO: Change the autogenerated stub
                break;
        }
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with("Place Origin", array('class' => 'col-md-4'))
                ->add('placefrom', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'label' => 'Place From'
                ))
                ->add('starttime', 'sonata_type_datetime_picker', array(
                    'label' => 'Pick-up Time',
                    'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->end()
                ->with("Place Destination", array('class' => 'col-md-4'))
                ->add('placeto', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'label' => 'Place To'
                ))
                ->add('endtime', 'sonata_type_datetime_picker', array(
                    'label' => 'Drop-off Time',
                    'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('reverse')
                ->end()
                ->with('Transfer Colective Block', array('class' => 'col-md-4'))
                ->add('pricepax', 'money', array('currency' => 'USD'))
                ->end()
                ->with('Product Property')
                ->add('provider', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Provider',
                     
                ))
                ->add('productIncrement', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ProductIncrement',
                    'label' => 'Increment',
                ))
                ->add('stop')
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
                ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Transfer Name'))
                ->add('placefrom', null, array('label' => 'Place From'))
                ->add('placeto', null, array('label' => 'Place To'))
                ->add('pricepax', null, array(), 'sonata_type_filter_number')
                ->add('priority', null, array(), 'sonata_type_filter_number')
                ->add('available')
                ->add('payonline')
                ->add('provider')

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
               
                ->addIdentifier('id', null, array('label' => 'Id'))
                ->add('pricepax', 'money', array('editable' => true))
                ->add('placefrom', null, array('label' => 'Place From', 'editable' => true))
                ->add('placeto', null, array('label' => 'Place To', 'editable' => true))
                ->add('available', null, array('editable' => true))
                ->add('priority', null, array('editable' => true))
                ->add('provider')
                ->add('getFromprice')
                ->add('campaigns')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        
                        'apply' => array(
                            'template' => 'DaiquiriReservationBundle:Transfer:request_buttom.html.twig'
                        ),
                        'form-transfer-colective-item' => array(
                            'template' => 'DaiquiriReservationBundle:Default:book.html.twig'
                        ),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;

    public function prePersist($object) {
        $object->setTitle($object . "");
    }

    public function preUpdate($object) {
        $object->setTitle($object . "");
    }

}
