<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransferColectiveItemType extends AbstractType {

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
                ->add('flight', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Flight',
                    'property' => 'title',
                    'label' => 'Select your Fligth',
                    'required' => true,                    
                ))
                ->add('title')                
                ->add('passengers')
                ->add('unitariprice')
                ->add('quantity')
                ->add('totalprice')
                ->add('startdate', 'date', array(
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
            'data_class' => 'Daiquiri\ReservationBundle\Entity\TransferColectiveItem',
            
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_transfercolectiveitem';
    }

}
