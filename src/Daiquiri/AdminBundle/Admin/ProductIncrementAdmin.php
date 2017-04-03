<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductIncrementAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {        
        $formMapper
                ->add('increment', 'percent'
                        , array('label' => 'Increment value in range 0 - 100% (e.g., 15)'))
                ->add('productType')

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('increment', null, array(), 'sonata_type_filter_number')
                ->add('productType')

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('increment', 'percent', array('editable' => true))
                ->add('productType')
        ;
    }

    public $supportsPreviewMode = true;


}
