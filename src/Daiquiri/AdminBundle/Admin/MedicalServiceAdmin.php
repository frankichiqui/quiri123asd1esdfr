<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MedicalServiceAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Medical Service Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Medical Service Description',
                    'format' => 'richhtml'
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
                ->with('Medical Program')
                ->add('medicalProgram')
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
                    'preferred_choices' => array('en', 'es', 'it' )
                ))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Medical Service Name'))
                ->add('medicalProgram', null, array('label' => 'Medical Program Name'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Medical Service Name'))
                ->add('medicalProgram', null, array('label' => 'Medical Program'))
                ->add('available', null, array('editable' => true))
                ->add('payonline', null, array('editable' => true))
                ->add('priority', null, array('editable' => true))
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Medical Service Description'
                    )
                ))
                ->add('term_condition_product', null, array('label' => 'Terms & Conditions'))
                ->add('gallery')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                        'apply' => array(
                            'template' => 'DaiquiriReservationBundle:Medical:request_buttom.html.twig'
                        ),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;

}
