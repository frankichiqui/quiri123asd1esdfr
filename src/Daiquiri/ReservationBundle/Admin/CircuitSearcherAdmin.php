<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CircuitSearcherAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        //$lista_place = $this->getModelManager()->findBy(array('ispickupplace_circuit'=>true));
        $em = $this->modelManager->getEntityManager('Daiquiri\AdminBundle\Entity\Place');
        $query = $em->createQueryBuilder('p')
                ->select('p')
                ->from('DaiquiriAdminBundle:Place', 'p')
                ->where('p.ispickupplace_circuit = TRUE')
        ;
        $formMapper
                ->add('circuit', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Circuit',
                    'required' => false,
                ))
                ->add('title', new \Daiquiri\AdminBundle\Form\Type\FindAutoCompleteType(), array(
                    'label' => 'Circuit name',
                    'entities' => array(
                        array(
                            'class' => 'Circuit',
                            'icon' => 'fa fa-refresh',
                            'route' => 'daiquiri_admin_autocomplete_get_location',
                            'property' => 'title'
                        ))
                ))
                ->add('date', 'sonata_type_date_picker', array(
                    'label' => 'Departure',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->format("M j, Y"),
                    'required' => true))
                ->add('days', 'genemu_jqueryselect2_choice', array('choices' => array(
                        -1 => 'Anyone',
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
                        11 => '10 +'
                    ),
                    'required' => false
                ))
                ->add('nights', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        -1 => 'Anyone',
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
                        11 => '10 +'
                    ),
                    'label' => 'Night',
                    'required' => false
                ))
                ->add('adults', 'genemu_jqueryselect2_choice', array(
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
                    'label' => 'Adults',
                    'required' => true
                ))
                ->add('kids', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        0 => '0',
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
                    'label' => 'Kids',
                    'required' => true
                ))
                ->add('places', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'multiple' => true,
                    'property' => 'title',
                    'required' => false,
                ))
                ->add('polofrom', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',                    
                    'property' => 'title',
                    'required' => false,
                ))




        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        
    }

    public $supportsPreviewMode = true;

//    public function getFormBuilder() {
//        $this->formOptions['data_class'] = $this->getClass();
//        $this->formOptions['csrf_protection'] = false;
//        $formBuilder = $this->getFormContractor()->getFormBuilder(
//                $this->getUniqid(), $this->formOptions
//        );
//        $this->defineFormBuilder($formBuilder);
//        return $formBuilder;
//    }
}
