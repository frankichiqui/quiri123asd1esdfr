<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class FlightAdmin extends AbstractAdmin {

    

    protected function configureFormFields(FormMapper $formMapper) {          
        $formMapper
                ->with('Fligth', array('class' => 'col-md-9'))
                ->add('title', 'text', array('label' => 'Flight Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Flight Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->end()
               
                
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Flight'))
                ->add('airline', null)
        ;
    }
    
    protected function configureListFields(ListMapper $listMapper) {
        
              
        $listMapper
                ->addIdentifier('title')
                ->add('airline')
                ->add('airports')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Flight Description'
                    )
                ))
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
