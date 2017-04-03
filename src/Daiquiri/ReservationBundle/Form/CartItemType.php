<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CartItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('unitariprice')
            ->add('quantity', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(                       
                        1 => 'One',
                        2 => 'Two',
                        3 => 'Three',                      
                    ),                   
                    'required' => true
                ))
            ->add('product', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product'
                ))
            ->add('totalprice')
           
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\CartItem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'daiquiri_reservationbundle_cartitem';
    }
}
