<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class ExcursionColectiveItemType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('pickupplace', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                                ->where('p.ispickupplace_excursion = TRUE');
                    }
                ))
                ->add('dropoffplace', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place'
                ))
                ->add('title')
                ->add('unitariprice')
                ->add('quantity')
                ->add('adult')
                ->add('kid')
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
            'data_class' => 'Daiquiri\ReservationBundle\Entity\ExcursionColectiveItem'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_excursioncolectiveitem';
    }

}
