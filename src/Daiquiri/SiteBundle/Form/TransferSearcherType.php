<?php

namespace Daiquiri\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransferSearcherType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('exclusive', 'choice', array(
                    'choices' => array(
                        -1 => 'All',
                        0 => 'Colective',
                        1 => 'Exclusive'
                    )
                ))
                ->add('passengers', 'choice', array(
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
                ->add('startdate')
                ->add('date', null, array('widget' => 'single_text', 'format' => 'MMMM d, yyyy'))
                ->add('roundtrip')
                ->add('dateroundtrip', null, array('widget' => 'single_text', 'format' => 'MMMM d, yyyy'))
                ->add('polofrom', null, array(
                    'placeholder' => 'Anywhere',
                    'empty_data' => null,
                    'required' => false
                ))
                ->add('poloto', null, array(
                    'placeholder' => 'Anywhere',
                    'empty_data' => null,
                    'required' => false
                ))
                ->add('transfer')
                ->add('placefrom', null, array(
                    'placeholder' => 'Anywhere',
                    'empty_data' => null,
                    'required' => false
                ))
                ->add('placeto', null, array(
                    'placeholder' => 'Anywhere',
                    'empty_data' => null,
                    'required' => false
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\TransferSearcher'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_sitebundle_transfersearcher';
    }

}
