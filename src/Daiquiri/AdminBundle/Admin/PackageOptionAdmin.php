<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class PackageOptionAdmin extends AbstractAdmin {

    public $routeitem = 'form-package-option-item';

   

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with('Package Option Block')
                ->add('title', 'text', array('label' => 'Option Title'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Option Description',
                    'format' => 'richhtml'
                ))
                ->end()
                ->with('Duration', array('class' => 'col-md-6'))
                ->add('days')
                ->add('nigths')
                ->add('polos', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'multiple' => true,
                    'by_reference' => false
                ))
                ->end()
                ->with('Product Property', array('class' => 'col-md-6'))
                ->add('productIncrement', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ProductIncrement',
                    'label' => 'Increment',
                ))
                ->add('priority')
                ->add('available')
                //->add('payonline')
                ->add('reviewAvailable')
                
                ->end()
                ->add('include', 'sonata_simple_formatter_type', array(
                    'label' => 'Option Include',
                    'format' => 'richhtml'
                ))
                ->add('notinclude', 'sonata_simple_formatter_type', array(
                    'label' => 'Option Not Include',
                    'format' => 'richhtml'
                ))
                ->add('priceadult', 'money', array(
                    'currency' => 'usd'
                ))
                ->add('pricekid', 'money', array(
                    'currency' => 'usd'
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
                ->add('title', null, array('label' => 'Circuit Name'))
                /* ->add('circuit_availabilitys', 'doctrine_orm_model_autocomplete', array('label' => 'Circuit Availability'), null, array(
                  'property' => 'title'
                  )) */
                ->add('available')
                //->add('payonline')
                ->add('priority', null, array(), 'sonata_type_filter_number')



        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Circuit'))
                ->add('package.title')
                ->add('polos')
                ->add('days')
                ->add('nigths')
                ->add('campaigns')
                ->add('available', null, array('editable' => true))
                //->add('payonline', null, array('editable' => true))
                ->add('priority', null, array('editable' => true))
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Circuit Description'
                    )
                ))
                ->add('term_condition_product', null, array('label' => 'Terms & Conditions'))
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
