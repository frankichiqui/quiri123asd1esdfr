<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CarItemType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('pickupplace', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place'
                ))
                ->add('dropoffplace', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place'
                ))
                ->add('startdate', 'datetime', array(
                    'widget' => 'single_text',
                    // this is actually the default format for single_text
                    'format' => 'yyyy-MM-dd H:mm',
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
                ->add('product', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product'
                ))
                ->add('totalprice')
                ->add('enddate', 'datetime', array(
                    'widget' => 'single_text',
                    // this is actually the default format for single_text
                    'format' => 'yyyy-MM-dd H:mm',
                ))
                ->add('front')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\CarItem'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_caritem';
    }

}
