<?php

namespace Daiquiri\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CarRequestType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
//        $em->getEntityManager('Daiquiri\AdminBundle\Entity\Place');
//        $query = $em->createQueryBuilder('p')
//                ->select('p')
//                ->from('DaiquiriAdminBundle:Place', 'p')
//                ->where('p.ispickupplace_car = TRUE');
        $builder
                ->add('gender', 'entity', array('class' => 'Daiquiri\ReservationBundle\Entity\Gender', 'attr' => array('data-sonata-select2' => 'false')))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Pickup date',
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->format("M j, Y"),
                    'dp_min_date' => (new \DateTime('now'))->modify('+ 4 days')->format("M j, Y"),
                    'attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('starttime', 'sonata_type_datetime_picker', array(
                    'label' => 'Pickup Time',
                    'format' => 'hh:mm a',
                    'widget_icon' => 'fa fa-clock-o',
                    'dp_pick_date' => false,
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4days')->modify('+ 1 hour')->format("g:i a"),
                    'required' => true))
                ->add('endtime', 'sonata_type_datetime_picker', array(
                    'label' => 'Dropoff Time Time',
                    'format' => 'hh:mm a',
                    'widget_icon' => 'fa fa-clock-o',
                    'dp_pick_date' => false,
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 5 days')->modify('+ 1 hour')->format("g:i a"),
                    'required' => true))
                ->add('enddate', 'sonata_type_date_picker', array(
                    'label' => 'Dropoff date',
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 5 days')->format("M j, Y"),
                    'dp_min_date' => (new \DateTime('now'))->modify('+ 5 days')->format("M j, Y"),
                    'attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('paxname', null, array('label' => 'Name', 'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('paxlastname', null, array('label' => 'Lastname', 'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('paxemail', 'email', array('label' => 'Email', 'attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('birthdate', 'sonata_type_date_picker', array(
                    'label' => 'BirthDate',
                    'dp_default_date' => (new \DateTime('now'))->modify('- 20 years')->format("M j, Y"),
                    'attr' => array('class' => 'form-control'),
                    'required' => false))
                ->add('captcha', null, array('label' => 'Captcha', 'attr' => array('class' => 'form-control'),
                    'required' => true))
                ->add('car', 'entity', array('class' => 'Daiquiri\AdminBundle\Entity\Car', 'attr' => array('data-sonata-select2' => 'false')))
                ->add('pickupplace', 'entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'fullTitle',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                                ->select('q')
                                ->from('DaiquiriAdminBundle:Place', 'q')
                                ->where('q.ispickupplace_car = TRUE');
                    },
                    'attr' => array('data-sonata-select2' => 'false')))
                ->add('dropoffplace', 'entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'fullTitle',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('q')
                                ->select('s')
                                ->from('DaiquiriAdminBundle:Place', 's')
                                ->where('s.ispickupplace_car = TRUE');
                    },
                    'attr' => array('data-sonata-select2' => 'false')))
                ->add('remarks', new \Symfony\Component\Form\Extension\Core\Type\TextareaType(), array('required' => false,'max_length' => 200));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Daiquiri\ReservationBundle\Entity\CarRequest'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'daiquiri_reservationbundle_carrequest';
    }

}
