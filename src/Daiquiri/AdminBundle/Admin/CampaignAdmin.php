<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CampaignAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('markets', null, array('label' => 'Markets'))
                ->add('available', null, array('label' => 'Visible'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('title')
                ->add('priority', null, array(
                    'editable' => true
                ))
                ->add('available', null, array(
                    'editable' => true
                ))
                ->add('markets')
                ->add('type')
                ->add('details')
                ->add('block')
                
        ;
    }

//    public function prePersist($airline) {
//        $this->preUpdate($airline);
//    }
//
//    public function preUpdate($airline) {
//        $airline->setFlights($airline->getFlights());
//    }

    public $supportsPreviewMode = true;

}
