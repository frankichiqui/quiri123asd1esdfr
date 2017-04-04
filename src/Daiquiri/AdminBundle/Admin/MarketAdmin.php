<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class MarketAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->with('Data', array('class' => 'col-md-6'))
                ->add('title', null, array('label' => 'Market'))
                ->add('increment', 'percent', array('label' => 'Increment value in range 0 - 100% (e.g., 15)'))
                ->end()
                ->with('Countries', array('class' => 'col-md-6'))
                ->add('countries', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Country',
                    'property' => 'title',
                    'multiple' => true,
                    
                ))
                ->end()
               

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Market'))
                ->add('countries', null, array('multiple' => true))
                ->add('increment', null, array(), 'sonata_type_filter_number')

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title', null, array('label' => 'Market'))
                ->add('increment', 'percent')
                ->add('countries')
        ;
    }
    public function prePersist($market) {
        $this->preUpdate($market);
       
    }

    public function preUpdate($market) {
        $market->setCountries($market->getCountries());
         $market->setTitle(strtoupper($market->getTitle()));
    }

    public $supportsPreviewMode = true;

}
