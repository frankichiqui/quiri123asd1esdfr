<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PackageRequestType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('adult', 'choice', array('choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                        0 => 0,
                    ), 'attr' => array('data-sonata-select2' => 'false')))
                ->add('kid', 'choice', array('choices' => array(
                        0 => 0,
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ), 'attr' => array('data-sonata-select2' => 'false')))
                ->add('gender', 'entity', array('class' => 'Daiquiri\ReservationBundle\Entity\Gender', 'attr' => array('data-sonata-select2' => 'false')))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Check In',
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 30 days')->format("M j, Y"),
                    'dp_min_date' => (new \DateTime('now'))->modify('+ 30 days')->format("M j, Y"),
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
                ->add('package')
                ->add('packageoption', 'entity', array('class' => 'Daiquiri\AdminBundle\Entity\packageOption', 'attr' => array('data-sonata-select2' => 'false')))
                ->add('remarks', new \Symfony\Component\Form\Extension\Core\Type\TextareaType(), array('required' => false,'max_length' => 200));
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\PackageRequest'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_packagerequest';
    }

}
