<?php

namespace Daiquiri\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OcupationSearcherType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('adults', 'choice', array(
                    'choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ),
                    'required' => true
                ))
                ->add('kids', 'choice', array(
                    'choices' => array(
                        0 => 0,
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ),
                    'required' => true
                ))
                ->add('infants', 'choice', array(
                    'choices' => array(
                        0 => 0,
                        1 => 1,
                        2 => 2,
                    ),
                    'required' => true
                ))
                ->add('startdate', 'date', array(
                    'widget' => 'single_text',
                    'format' => "MMMM d, yyyy",
                ))
                ->add('enddate', 'date', array(
                    'widget' => 'single_text',
                    'format' => "MMMM d, yyyy"))
                ->add('ubication', new \Daiquiri\AdminBundle\Form\Type\FindAutoCompleteType(), array(
                    'attr' => array('placeholder' => 'Where are you going?'),
                    'entities' => array(
                        array(
                            'class' => 'Hotel',
                            'icon' => 'fa fa-building-o',
                            'route' => 'daiquiri_admin_autocomplete_get_location',
                            'property' => 'title'
                        ),
                        array(
                            'class' => 'Polo',
                            'icon' => 'fa fa-map-marker',
                            'route' => 'daiquiri_admin_autocomplete_get_location',
                            'property' => 'title'
                        ),
                        array(
                            'class' => 'Province',
                            'icon' => 'fa fa-map-o',
                            'route' => 'daiquiri_admin_autocomplete_get_location',
                            'property' => 'title'
                        ),
                        array(
                            'class' => 'Chain',
                            'icon' => 'fa fa-chain',
                            'route' => 'daiquiri_admin_autocomplete_get_location',
                            'property' => 'title'
                        ),
                        array(
                            'class' => 'Airport',
                            'icon' => 'fa fa-plane',
                            'route' => 'daiquiri_admin_autocomplete_get_location',
                            'property' => 'title'
                        )
                    )
                ))
                ->add('createAt')
                ->add('polo')
                ->add('hotel')
                ->add('chain')
                ->add('room')
                ->add('province')
                ->add('HotelType')
                ->add('facilities')
                ->add('facilities_room')
                ->add('user')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\OcupationSearcher'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_sitebundle_ocupationsearcher';
    }

}
