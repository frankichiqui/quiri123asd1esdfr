<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CircuitItemType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('adults')
                ->add('kids')
                ->add('pickupplace', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                                ->where('p.ispickupplace_circuit = TRUE');
                    }
                ))
                ->add('title')
                ->add('unitariprice')
                ->add('quantity')
                ->add('ocupation', 'choice', array('choices' => array(1 => 'Sgl',
                        2 => 'Dbl')))
                ->add('totalprice')
                ->add('startdate', 'date', array(
                    'widget' => 'single_text',
                    // this is actually the default format for single_text
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('product', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product'
                ))
                ->add('front', null, array('attr' => array('type' => 'hidden')))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\CircuitItem'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_circuititem';
    }

}
