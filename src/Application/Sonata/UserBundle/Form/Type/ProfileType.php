<?php

namespace Application\Sonata\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Sonata\UserBundle\Form\Type\ProfileType as BaseType;

class ProfileType extends BaseType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        // agrega tu campo personalizado
        $builder->add('passport', 'integer')
                ->add('email', 'email')
                ->add('picture', 'file', array(
                    'data_class' => null,
                    'property_path' => 'picture',
                    'required' => null
                        )
                )
                ->add('address')
                ->add('city')
                ->add('state')
                ->add('zipcode', 'integer')
                ->add('country', 'country')
                ->add('button', 'submit')
        ;
    }

    public function getName() {
        return 'application_user_profile';
    }

}
