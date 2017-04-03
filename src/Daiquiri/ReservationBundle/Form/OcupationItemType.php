<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OcupationItemType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('hotel', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Hotel'
                ))
                ->add('room', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Room'
                ))
                ->add('kids')
                ->add('adults')
                ->add('plan', 'choice', array(
                    'choices' => $options['plan'],
                    'required' => true,
                    'label' => 'Plan'
                ))
                ->add('infants')
                ->add('enddate', 'date', array(
                    'widget' => 'single_text',
                    // this is actually the default format for single_text
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('title')
                ->add('unitariprice')
                ->add('quantity', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
                    ),
                    'label' => 'Quantity',
                    'required' => true
                ))
                ->add('totalprice')
                ->add('startdate', 'date', array(
                    'widget' => 'single_text',
                    // this is actually the default format for single_text
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('product', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Ocupation'
                ))
                ->add('front')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\OcupationItem',
            'plan' => array(1 => 'B&B')
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_ocupationitem';
    }

}
