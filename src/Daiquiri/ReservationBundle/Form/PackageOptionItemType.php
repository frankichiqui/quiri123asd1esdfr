<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PackageOptionItemType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('pickupplace', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'label' => 'Pickup place Hotel',
                    'required' => true,
                    
                ))
                ->add('kids')
                ->add('adults')
                ->add('infants')
                ->add('title')
                ->add('unitariprice')
                ->add('quantity')
                ->add('totalprice')
                ->add('startdate')
                ->add('product', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\PackageOption'
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\PackageOptionItem'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_packageoptionitem';
    }

}
