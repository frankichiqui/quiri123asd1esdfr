<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class RequestAdmin extends AbstractAdmin {

    protected $datagridValues = array(
        // display the first page (default = 1)
        '_page' => 1,
        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',
        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'id',
    );

    protected function configureFormFields(FormMapper $formMapper) {
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('id')
                ->add('createAt')
                ->add('gender')
                ->add('getFullClientName')
                ->add('paxemail')
                ->add('getPaxage')
                ->add('ipclient')
                ->add('remarks')
                ->add('getFullInfo');
    }

    public $supportsPreviewMode = true;

}
