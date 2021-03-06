<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class HotelPriceAdmin extends AbstractAdmin {

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('form-set-hotel-price', $this->getRouterIdParameter() . '/form-set-hotel-price');
    }

    /**
     * @param string $name
     * @return null|string
     */
    public function getTemplate($name) {
        switch ($name) {
            case 'create':
                return 'DaiquiriAdminBundle:HotelPrice:form_hotel_price.html.twig';
                break;
            default:
                return parent::getTemplate($name); // TODO: Change the autogenerated stub
                break;
        }
    }

    public function prePersist($hotelprice) {
        $this->preUpdate($hotelprice);
    }

    public function preUpdate($hotelprice) {
        $hotelprice->setKidpolicys($hotelprice->getKidpolicys());
        $hotelprice->UpdateAllPrice();
    }

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->add('season', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Season'
                ))
                ->add('room', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Room'
                ))
                ->add('base', 'number', array('label' => 'Base Price ', 'attr' => array(
                        'class' => ' form-control')))
                ->add('individual', 'number', array('label' => 'Individual Use ', 'attr' => array(
                        'class' => ' form-control')))
                ->add('cHindividual', 'choice', array(
                    'label' => 'Type',
                    'empty_data' => 2,
                    'choices' => array(
                        1 => '%',
                        2 => '$'),
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('three', 'number', array('label' => '3th Pax Discount ', 'attr' => array(
                        'class' => ' form-control')))
                ->add('cHthree', 'choice', array(
                    'label' => 'Type',
                    'empty_data' => 2,
                    'choices' => array(
                        1 => '%',
                        2 => '$'),
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kidpolicys', 'sonata_type_collection', array(
                    'by_reference' => false,
                    'type_options' => array(
                        // Prevents the "Delete" option from being displayed
                        'delete' => false,
                        'delete_options' => array(
                            // You may otherwise choose to put the field but hide it
                            'type' => 'hidden',
                            // In that case, you need to fill in the options as well
                            'type_options' => array(
                                'mapped' => false,
                                'required' => false,
                            )
                        )
                    )
                        ), array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
        ));
    }

    protected function configureDatagridFilters(DatagridMapper $empty_datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        
    }

    public $supportsPreviewMode = true;

}
