<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OcupationSearcherAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
//                ->add('ubication', new \Daiquiri\AdminBundle\Form\Type\FindAutoCompleteType(), array(
//                    'label' => 'Where are you going?',
//                    'entities' => array(
//                        array(
//                            'class' => 'Hotel',
//                            'icon' => 'fa fa-building-o',
//                            'route' => 'daiquiri_admin_autocomplete_get_location',
//                            'property' => 'title'
//                        ),
//                        array(
//                            'class' => 'Polo',
//                            'icon' => 'fa fa-map-marker',
//                            'route' => 'daiquiri_admin_autocomplete_get_location',
//                            'property' => 'title'
//                        ),
//                        array(
//                            'class' => 'Province',
//                            'icon' => 'fa fa-map-o',
//                            'route' => 'daiquiri_admin_autocomplete_get_location',
//                            'property' => 'title'
//                        ),
//                        array(
//                            'class' => 'Chain',
//                            'icon' => 'fa fa-chain',
//                            'route' => 'daiquiri_admin_autocomplete_get_location',
//                            'property' => 'title'
//                        ),
//                        array(
//                            'class' => 'Airport',
//                            'icon' => 'fa fa-plane',
//                            'route' => 'daiquiri_admin_autocomplete_get_location',
//                            'property' => 'title'
//                        )
//                    )
//                ))
                ->add('startdate', 'sonata_type_date_picker', array(
                    'label' => 'Check in',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 4 days')->modify('+ 1 hour')->format("M j, Y"),
                    'required' => true))
                ->add('enddate', 'sonata_type_date_picker', array(
                    'label' => 'Check in',
                    'attr' => array('class' => 'form-control'),
                    'dp_default_date' => (new \DateTime('now'))->modify('+ 5 days')->format("M j, Y"),
                    'required' => true))
                ->add('hotel', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Hotel',
                    'required' => false,
                ))
                ->add('province', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Province',
                    'property' => 'title',
                    'required' => false
                ))
                ->add('chain', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Chain',
                    'property' => 'title',
                    'required' => false
                ))
                ->add('room', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Room',
                    'required' => false,
                ))
                ->add('polo', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Polo',
                    'property' => 'title',
                    'required' => false
                ))
                ->add('adults', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ),
                    'label' => 'Adults',
                    'required' => true
                ))
                ->add('kids', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        0 => 0,
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ),
                    'label' => 'Kids',
                    'required' => true
                ))
                ->add('infants', 'genemu_jqueryselect2_choice', array(
                    'choices' => array(
                        0 => 0,
                        1 => 1,
                        2 => 2,
                    ),
                    'label' => 'Infants (0 - 1.99 years)',
                    'required' => true
                ))
                ->add('facilities', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouseFacilityType',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true
                ))
                ->add('facilities_room', 'sonata_type_model', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\RentalHouseRoomFacility',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true
                ))

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('createAt')
                ->add('user')
                ->add('polo')
                ->add('hotel')
                ->add('chain')
                ->add('room')
                ->add('province')
                ->add('HotelType')
                ->add('facilities')
                ->add('facilities_room')
                ->add('adults')
                ->add('kids')
                ->add('infants')
                ->add('startdate')
                ->add('enddate')
                ->add('ubication')

        ;
    }

    public function prePersist($object) {
        $object->setCreateAt(new \DateTime('now'));
       // dump($object);die;
    }

    public $supportsPreviewMode = true;

}
