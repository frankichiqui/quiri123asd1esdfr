<?php

namespace Daiquiri\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FindAutoCompleteType extends AbstractType {    

    public function finishView(\Symfony\Component\Form\FormView $view, \Symfony\Component\Form\FormInterface $form, array $options) {
        parent::finishView($view, $form, $options);
        $view->vars['entities'] = $options['entities'];
    }

    public function getParent() {
        return 'text';
    }

    public function getName() {
        return 'findautocomplete';
    }

    public function getBlockPrefix() {
        return 'findautocomplete';
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'required' => false,
            'entities' => array(
                array(
                    'class' => 'Hotel',
                    'icon' => 'fa fa-building',
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
                    'class' => 'Zone',
                    'icon' => 'fa fa-map-marker',
                    'route' => 'daiquiri_admin_autocomplete_get_location',
                    'property' => 'title'
                ),
                array(
                    'class' => 'Province',
                    'icon' => 'fa fa-map-marker',
                    'route' => 'daiquiri_admin_autocomplete_get_location',
                    'property' => 'title'
                )
            )
        ));
    }

}
