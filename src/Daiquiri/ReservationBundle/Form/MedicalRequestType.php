<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MedicalRequestType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('gender', 'entity', array('class' => 'Daiquiri\ReservationBundle\Entity\Gender', 'attr' => array('data-sonata-select2' => 'false')))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Start Date',
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
                ->add('medicalservice')
                ->add('remarks', new \Symfony\Component\Form\Extension\Core\Type\TextareaType(), array('required' => false,'max_length' => 200));
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\MedicalRequest'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_medicalrequest';
    }

}
