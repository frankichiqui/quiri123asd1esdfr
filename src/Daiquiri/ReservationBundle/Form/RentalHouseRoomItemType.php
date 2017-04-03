<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RentalHouseRoomItemType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('rentalhouse', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouse'
                ))
                ->add('room', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouseRoom'
                ))
                ->add('adult', 'choice', array('choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4)))
                ->add('kid', 'choice', array('choices' => array(
                        0 => 0,
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4)))
                ->add('enddate', 'sonata_type_date_picker', array(
                    'widget' => 'single_text',
                    // this is actually the default format for single_text
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('title')
                ->add('unitariprice')
                ->add('quantity', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        1 => 'One',
                        2 => 'Two',
                        3 => 'Three',
                    ),
                    'required' => true,
                    'label' => 'Quantity'
                ))
                ->add('totalprice')
                ->add('startdate', 'sonata_type_date_picker', array(
                    'widget' => 'single_text',
                    // this is actually the default format for single_text
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('product', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product'
                ))
                ->add('front')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\RentalHouseRoomItem'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_rentalhouseroomitem';
    }

}
