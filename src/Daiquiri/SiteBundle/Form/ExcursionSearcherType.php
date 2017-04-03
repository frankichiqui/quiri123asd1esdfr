<?php

namespace Daiquiri\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExcursionSearcherType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('date', null, array('widget' => 'single_text', 'format' => 'MMMM d, yyyy'))
                ->add('exclusive', 'choice', array(
                    'choices' => array(
                        0 => 'Colective',
                        1 => 'Exclusive'
                    )
                ))
                ->add('duration', 'choice', array(
                    'choices' => array(
                        0 => '-',
                        1 => '1 Hour',
                        2 => '2 Hours',
                        3 => '3 Hours',
                        4 => '4 Hours',
                        5 => '5 Hours',
                        6 => '6 Hours',
                        7 => '7 Hours',
                        8 => '8 Hours',
                        9 => '9 Hours',
                        10 => '10 Hours',
                        11 => '11 Hours',
                        12 => '12 Hours',
                        13 => '13 Hours',
                        14 => '14 Hours',
                        15 => '15 Hours',
                        16 => '16 Hours',
                        17 => '17 Hours',
                        18 => '18 Hours',
                        19 => '19 Hours',
                        20 => '20 Hours',
                        21 => '21 Hours',
                        22 => '22 Hours',
                        23 => '23 Hours',
                        24 => '24 Hours'
                    ),
                    'label' => 'Duration',
                    'required' => true
                ))
                ->add('adults', 'choice', array(
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
                    'required' => true
                ))
            ->add('kids', 'choice', array(
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
                    'required' => true
                ))
                ->add('polo')
                ->add('excursion')
                ->add('polofrom')
                ->add('types')
                ->add('places')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\ExcursionSearcher'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_sitebundle_excursionsearcher';
    }

}
