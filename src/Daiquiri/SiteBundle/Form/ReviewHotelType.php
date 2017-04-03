<?php

namespace Daiquiri\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReviewHotelType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title')
                ->add('description', 'textarea')
                ->add('votes')
                ->add('hotel', 'entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Hotel',
                ))

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\AdminBundle\Entity\ReviewHotel'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_sitebundle_reviewhotel';
    }

}
