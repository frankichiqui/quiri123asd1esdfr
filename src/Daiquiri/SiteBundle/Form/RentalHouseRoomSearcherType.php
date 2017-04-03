<?php

namespace Daiquiri\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RentalHouseRoomSearcherType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('house', new \Daiquiri\AdminBundle\Form\Type\FindAutoCompleteType(), array(
                    'entities' => array(
                        array(
                            'class' => 'RentalHouse',
                            'icon' => 'fa fa-home',
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
                        )
                    )
                ))
                ->add('rooms', 'choice', array(
                    'choices' => array(
                        0 => 'All',
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                        7 => '7 +',
                    ),
                    'required' => true
                ))
                ->add('adults', 'choice', array(
                    'choices' => array(
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4'
                    ),
                    'required' => true
                ))
                ->add('kids', 'choice', array(
                    'choices' => array(
                        0 => '0',
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4'
                    ),
                    'required' => true
                ))
                ->add('PrivateRental')
                ->add('startdate', null, array('widget' => 'single_text', 'format' => 'MMMM d, yyyy'))
                ->add('enddate', null, array('widget' => 'single_text', 'format' => 'MMMM d, yyyy'))
                ->add('polo')
                ->add('rentalhouse')
                ->add('rentalhouseroom')
                ->add('province')
                ->add('facilities')
                ->add('facilities_room')
                ->add('type')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\RentalHouseRoomSearcher'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_sitebundle_rentalhouseroomsearcher';
    }

}
