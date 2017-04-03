<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CountryAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('isoCode', null, array('label' => 'ISO Code'))
                ->add('title', null, array('label' => 'Country'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Country Description',
                    'format' => 'richhtml',
                    'required' => false
                ))
                ->add('picture', 'sonata_media_type', array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->add('gallery', 'sonata_type_model_list', array('required' => false), array(
                    'provider' => 'sonata.media.provider.image',
                    'context' => 'daiquiri'
                ))
                ->end()
                ->with('Locale Block')
                ->add('locale', 'language', array(
                    'preferred_choices' => array('en', 'es', 'it' )
                ))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('isoCode', null, array('label' => 'ISO Code'))
                ->add('title', null, array('label' => 'Country'))
                ->add('market')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', null, array('label' => 'Country'))
                ->add('isoCode', null, array('editable' => true, 'label' => 'ISO Code'))
                ->add('market')
                ->add('market.increment', 'percent', array('label' => 'Market Increment'))

        ;
    }

    public function prePersist($country) {
        $this->preUpdate($country);
    }

    public function preUpdate($country) {
        $country->setIsoCode(strtoupper($country->getIsoCode()));
    }

    public $supportsPreviewMode = true;

}
