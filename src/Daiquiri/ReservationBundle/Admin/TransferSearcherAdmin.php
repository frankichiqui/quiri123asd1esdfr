<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class TransferSearcherAdmin extends AbstractAdmin {

    protected function configureRoutes(RouteCollection $collection) {
        $collection->add('addtocart', 'add-to-cart');
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('transfer', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Transfer',
                    'required' => false,
                ))
                ->add('date', 'sonata_type_date_picker', array(
                    'label' => 'Departure',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->modify('+ 1 hour')->format("M j, Y"),
                    'required' => true))
                ->add('polofrom', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'required' => false,
                    'placeholder' => 'Anywhere',
                    'btn_add' => false
                ))
                ->add('poloto', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'required' => false,
                    'placeholder' => 'Anywhere',
                    'btn_add' => false
                ))
                ->add('exclusive', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        -1 => 'All',
                        0 => 'Colective',
                        1 => 'Exclusive'
                    ), 'label' => 'Type'
                ))
                ->add('passengers', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                        7 => '7',
                        8 => '8',
                        9 => '9',
                        10 => '10',
                        11 => '11',
                        12 => '12',
                        13 => '13',
                        14 => '14',
                        15 => '15',
                        16 => '16',
                        17 => '17',
                        18 => '18',
                        19 => '19',
                        20 => '20',
                        21 => '21',
                        22 => '22',
                        23 => '23',
                        24 => '24',
                        25 => '25',
                        26 => '26',
                        27 => '27',
                        28 => '28',
                        29 => '29',
                        30 => '30',
                        31 => '31',
                        32 => '32',
                        33 => '33',
                        34 => '34',
                        35 => '35',
                        36 => '36',
                        37 => '37',
                        38 => '38',
                        39 => '39',
                        40 => '40'
                    ),
                    'label' => 'Paxs',
                    'required' => true
                ))
                ->add('roundtrip', 'checkbox', array(
                    'label' => 'Roundtrip ',
                    'required' => false))
                ->add('dateroundtrip', 'sonata_type_date_picker', array(
                    'label' => 'Return Date',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 5 days')->modify('+ 1 hour')->format("M j, Y"),
                    'required' => true))
                ->add('placefrom', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'placeholder' => '-',
                    'required' => false,
                    'btn_add' => false
                ))
                ->add('placeto', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'placeholder' => '-',
                    'required' => false,
                    'btn_add' => false
                ))

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        
    }

    public $supportsPreviewMode = true;

}
