<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BlockAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->with('Data')
                ->add('title', 'text', array('label' => 'Title'))
                ->add('visible', 'choice', array('choices' => array(
                        1 => "Yes",
                        0 => "No",
            )))
                ->add('mincampaign', 'choice', array('choices' => array(
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
                        40 => '40')
                ))
                ->add('number', 'choice', array('choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                        7 => '7',
                        8 => '8',
                        9 => '9',
                        10 => '10'
                    )
                ))
                ->end()
                ->with('Campaings')
                ->add('campaigns', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Campaign',
                    'btn_add' => false,
                    'multiple' => true,
                    'by_reference' => false
                ))
                ->end()


        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('title', null, array('label' => 'Block'))
                ->add('visible', null, array('label' => 'Visible'))
                ->add('mincampaign', null, array('label' => 'Min'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('title')
                ->add('visible', null, array('editable' => true,))
                ->add('mincampaign', null, array('editable' => true))
                ->add('number', null, array('editable' => true))
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
