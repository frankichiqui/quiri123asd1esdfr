<?php

//

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ExcursionSearcherAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        //$lista_place = $this->getModelManager()->findBy(array('ispickupplace_circuit'=>true));
//        $em = $this->modelManager->getEntityManager('Daiquiri\AdminBundle\Entity\Place');
//        $query = $em->createQueryBuilder('p')
//                ->select('p')
//                ->from('DaiquiriAdminBundle:Place', 'p')
//                ->where('p.ispickupplace_excursion = TRUE')
//        ;

        $formMapper
                ->add('date', 'sonata_type_date_picker', array(
                    'label' => 'Departure',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->modify('+ 1 hour')->format("M j, Y"),
                    'required' => true))
                ->add('polo', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'label' => 'Destination',
                    'required' => false,
                ))
                ->add('polofrom', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'required' => false,
                ))
                ->add('excursion', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Excursion',
                    'required' => false,
                ))
                ->add('places', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true,
                ))
                ->add('duration', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        0 => '-',
                        1 => '1 Hora',
                        2 => '2 Horas',
                        3 => '3 Horas',
                        4 => '4 Horas',
                        5 => '5 Horas',
                        6 => '6 Horas',
                        7 => '7 Horas',
                        8 => '8 Horas',
                        9 => '9 Horas',
                        10 => '10 Horas',
                        11 => '11 Horas',
                        12 => '12 Horas',
                        13 => '13 Horas',
                        14 => '14 Horas',
                        15 => '15 Horas',
                        16 => '16 Horas',
                        17 => '17 Horas',
                        18 => '18 Horas',
                        19 => '19 Horas',
                        20 => '20 Horas',
                        21 => '21 Horas',
                        22 => '22 Horas',
                        23 => '23 Horas',
                        24 => '24 Horas'
                    ),
                    'label' => 'Duration',
                    'required' => true
                ))
                ->add('types', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\ExcursionType',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true,
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
                ->add('exclusive', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        false => 'Colective',
                        true => 'Exclusive'
                    )
                ))



        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        
    }

    public $supportsPreviewMode = true;

}
