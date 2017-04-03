<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PaymentAdmin extends AbstractAdmin {

    protected $datagridValues = array(
        // display the first page (default = 1)
        '_page' => 1,
        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',
        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'orderId',
    );

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->with('Amount', array('class' => 'col-md-4'))
                ->add('amount', 'money', array('currency' => 'USD'))
                ->add('currency', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Currency',
                    'property' => 'title',
                ))
                ->end()
                ->with('Description', array('class' => 'col-md-8'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Description',
                    'format' => 'richhtml'
                ))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('orderId')
                ->add('client')
                ->add('amount')
                ->add('currency')
                ->add('response')
                ->add('error')
                ->add('cardCountry')
                ->add('authCode')
                ->add('cardType')
                ->add('status')
                ->add('pdfview', null, array('label' => 'PDF View'))
                ->add('createdFromIp')
                ->add('dateCreated', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('orderId')
                ->add('client')
                ->add('amount')
                ->add('currency')
                ->add('response')
                ->add('error')
                ->add('cardCountry')
                ->add('authCode')
                ->add('cardType')
                ->add('status')
                ->add('createdFromIp')
                ->add('dateCreated')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Description'
                    )
                ))
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'delete' => array(),
                    )
                ))
        ;
    }

    public $supportsPreviewMode = true;

}
