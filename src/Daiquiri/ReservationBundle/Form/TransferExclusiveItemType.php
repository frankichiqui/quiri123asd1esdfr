<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransferExclusiveItemType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    private $reverse;

    public function __construct($reverse = false) {
        $this->reverse = $reverse;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('pickup_time', 'sonata_type_datetime_picker', array(
                    'label' => 'Time',
                    'format' => 'hh:mm a',
                    'widget_icon' => 'fa fa-clock-o',
                    'dp_pick_date' => false,
                    'attr'=>array('class'=>'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->modify('+ 1 hour')->format("g:i a"),
                    'required' => true))
                ->add('pickupplace', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place'
                ))
                ->add('dropoffplace', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place'
                ))
                ->add('flight', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Flight',
                    'property' => 'title',
                    'label' => 'Select your Fligth',
                    'required' => true,
                ))
                ->add('title')
                ->add('passengers')
                ->add('unitariprice')
                ->add('quantity')
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
            'data_class' => 'Daiquiri\ReservationBundle\Entity\TransferExclusiveItem'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        
        return 'daiquiri_reservationbundle_transferexclusiveitem';
    }

}
