<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExcursionRequestType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('adult', 'choice', array('choices' => array(
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
                    ), 'attr' => array('data-sonata-select2' => 'false')))
                ->add('kid', 'choice', array('choices' => array(
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
                    ), 'attr' => array('data-sonata-select2' => 'false')))
                ->add('gender', 'entity', array('class' => 'Daiquiri\ReservationBundle\Entity\Gender', 'attr' => array('data-sonata-select2' => 'false')))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Check In',
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->format("M j, Y"),
                    'dp_days_of_week_disabled' => $options['disable_date_of_week'],
                    'dp_min_date' => (new \DateTime('now'))->modify('+ 4 days')->format("M j, Y"),
                    'attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('paxname', null, array('label' => 'Name', 'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('paxlastname', null, array('label' => 'Lastname', 'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('paxemail', 'email', array('label' => 'Email', 'attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('birthdate', 'sonata_type_date_picker', array(
                    'label' => 'BirthDate',
                    'dp_default_date' => (new \DateTime('now'))->modify('- 20 years')->format("M j, Y"),
                    'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('captcha', null, array('label' => 'Captcha', 'attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('excursion', 'entity', array('class' => 'Daiquiri\AdminBundle\Entity\Excursion', 'attr' => array('data-sonata-select2' => 'false')))
                ->add('remarks', new \Symfony\Component\Form\Extension\Core\Type\TextareaType(), array('required' => false, 'max_length' => 200));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\ExcursionRequest',
            'disable_date_of_week' => array()
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_excursionrequest';
    }

}
