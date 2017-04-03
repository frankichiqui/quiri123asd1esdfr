<?php

namespace Daiquiri\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MinMaxInputType extends AbstractType {

    public function configureOptions(OptionsResolver $resolver) {
        
        $id = uniqid();
        $resolver->setDefaults(array(           
            'empty_data' => '0',
            'attr'=>array(               
                'value'=>'1',
                'min'=>'1',
                'max'=>'4',
                'name'=>  $id,
                'class'=>'input_number'
                )
        ));
    }

    public function getParent() {
        return 'number';
    }

    public function getName() {
        return 'minmaxinput';
    }

}
