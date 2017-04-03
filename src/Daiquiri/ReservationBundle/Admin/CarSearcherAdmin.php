<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityRepository;

class CarSearcherAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        //$lista_place = $this->getModelManager()->findBy(array('ispickupplace_circuit'=>true));
        $em = $this->modelManager->getEntityManager('Daiquiri\AdminBundle\Entity\Place');
        $query = $em->createQueryBuilder('p')
                ->select('p')
                ->from('DaiquiriAdminBundle:Place', 'p')
                ->where('p.ispickupplace_car = TRUE');

        $formMapper
                ->add('car', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Car',
                    'required' => false,
                ))
                ->add('pickupplace', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'label' => 'Pickupplace',
                    'btn_add' => false,
                    'required' => true,
                    'query' => $query
                ))
                ->add('startdate', 'sonata_type_datetime_picker', array(
                    'label' => 'Check in',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->modify('+ 1 hour')->format("M j, Y g:i a"),
                    'required' => true,))
                ->add('dropoffplace', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Place',
                    'property' => 'title',
                    'label' => 'DropoffPlace',
                    'btn_add' => false,
                    'required' => true,
                    'query' => $query
                ))
                ->add('enddate', 'sonata_type_datetime_picker', array(
                    'label' => 'Check out',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 5 days')->modify('+ 1 hour')->format("M j, Y g:i a"),
                    'required' => true))
                
                ->add('driver', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Driver',
                    'property' => 'title',
                    'label' => 'Driver',
                    'placeholder' => 'Without driver',
                    'required' => false,
                ))
                ->add('category', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CarCategory',
                    'property' => 'title',
                    'label' => 'Category',
                    'placeholder' => 'All',
                    'required' => false,
                ))
                ->add('class', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\CarClass',
                    'property' => 'title',
                    'label' => 'Class',
                    'placeholder' => 'All',
                    'required' => false,
                ))
                ->add('luggagecapacity', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\LuggageCapacity',
                    'property' => 'title',
                    'label' => 'Luggage Capacity',
                    'placeholder' => 'All',
                    'required' => false,
                ))
                ->add('capacity', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        2 => '2',
                        4 => '4',
                        6 => '6',
                        9 => '9',
                    ),
                    'label' => 'Capacity',
                    'placeholder' => 'All',
                    'required' => false
                ))


        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        
    }

    public $supportsPreviewMode = true;

}
