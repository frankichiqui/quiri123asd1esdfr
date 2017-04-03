<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Route\RouteCollection;

class ResultAdmin extends AbstractAdmin {

    protected $datagridValues = array(
        // display the first page (default = 1)
        '_page' => 1,
        // reverse order (default = 'ASC')
        '_sort_order' => 'DESC',
        // name of the ordered field (default = the model's id field, if any)
        '_sort_by' => 'createAt',
    );

    protected function configureRoutes(RouteCollection $collection) {

        // You can also pass a single string argument
        $collection->remove('create');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('createAt', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('product')
                ->add('startdate', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('enddate', 'doctrine_orm_datetime_range', array('field_type' => 'sonata_type_datetime_range_picker'))
                ->add('adults', null, array(), 'sonata_type_filter_number')
                ->add('kids', null, array(), 'sonata_type_filter_number')
                ->add('infants', null, array(), 'sonata_type_filter_number')
                ->add('market')
                ->add('searcher.user')
                ->add('flight');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('createAt', null, array('label' => 'Create'))
                ->add('searcher')
                ->add('product')
                ->add('startdate', 'date', array('format' => 'M j, Y'))
                ->add('enddate', 'date', array('format' => 'M j, Y'))
                ->add('adults')
                ->add('kids')
                ->add('infants')
                ->add('market')
                ->add('obj')
                ->add('pickupplace', null, array('label' => 'Pickup'))
                ->add('dropoffplace', null, array('label' => 'Dropoff'))
                ->add('flight')
                ->add('passengers', null, array('label' => 'Paxs'))
                ->add('pickup_time', null, array('label' => 'time'))
                ->add('searcher.user', null, array('label' => 'user'))
                ->add('searcher.duration', null, array('label' => 'Duration(s)'))
        ;
    }

    public $supportsPreviewMode = true;

}
