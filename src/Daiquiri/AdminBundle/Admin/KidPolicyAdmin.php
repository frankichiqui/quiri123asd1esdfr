<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class KidPolicyAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $formMapper
                ->add('ocupation', 'entity_hidden', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Ocupation',
                ))
                ->add('kid1', 'number', array(
                    'label' => '1st Kid',
                    'empty_data' => 0,
                    'required' => true,
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kid1_choice', 'choice', array(
                    'label' => 'Type',
                    'choices' => array(
                        1 => '%',
                        2 => '$'),
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kid2', 'number', array(
                    'label' => '2nd Kid',
                    'empty_data' => 0,
                    'required' => true,
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kid2_choice', 'choice', array(
                    'label' => 'Type',
                    'choices' => array(
                        1 => '%',
                        2 => '$'),
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kid3', 'number', array(
                    'label' => '3 Kid',
                    'empty_data' => 100,
                    'required' => true,
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kid3_choice', 'choice', array(
                    'label' => 'Type',
                    'choices' => array(
                        1 => '%',
                        2 => '$'),
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kid4', 'number', array(
                    'label' => '4th Kid',
                    'empty_data' => 100,
                    'required' => true,
                    'attr' => array(
                        'class' => ' form-control')))
                ->add('kid4_choice', 'choice', array(
                    'label' => 'Type',
                    'choices' => array(
                        1 => '%',
                        2 => '$'),
                    'attr' => array(
                        'class' => ' form-control')));
    }

    protected function configureDatagridFilters(DatagridMapper $empty_datagridMapper) {
        
    }

    protected function configureListFields(ListMapper $listMapper) {
        
    }

    public $supportsPreviewMode = true;

}
