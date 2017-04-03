<?php

namespace Daiquiri\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PaymentType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('amount', 'number', array())
                ->add('currency', 'entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Currency',
                    'property' => 'title',
                ))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Description',
                    'format' => 'richhtml'
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\AdminBundle\Entity\Payment'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_sitebundle_payment';
    }

}
