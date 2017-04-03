<?php

namespace Daiquiri\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarSearcherType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('capacity', 'choice', array(
                    'choices' => array(
                        2 => '2',
                        4 => '4',
                        6 => '6',
                        9 => '9',
                    ),
                    'placeholder' => 'All',
                    'empty_data' => null,
                    'required' => false
                ))
                ->add('startdate', null, array('attr' => array('value' => (new \DateTime('now'))->modify('+ 4 days')->modify('+ 1 hour')->format("M j, Y, g:i:s a")), 'widget' => 'single_text', 'format' => 'M d, yyyy'))
                ->add('enddate', null, array('attr' => array('value' => (new \DateTime('now'))->modify('+ 5 days')->modify('+ 1 hour')->format("M j, Y, g:i:s a")), 'widget' => 'single_text', 'format' => 'M d, yyyy'))
                ->add('title')
                ->add('pickupplace', null, array('required' => true))
                ->add('dropoffplace', null, array('required' => true))
                ->add('luggagecapacity', null, array('placeholder' => 'All', 'empty_data' => null))
                ->add('car')
                ->add('category', null, array('placeholder' => 'All', 'empty_data' => null))
                ->add('class', null, array('placeholder' => 'All', 'empty_data' => null))
                ->add('driver', null, array('placeholder' => 'Without driver', 'empty_data' => null))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\CarSearcher'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_sitebundle_carsearcher';
    }

}
