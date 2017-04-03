<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProviderAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title', 'text', array('label' => 'Provider Name'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Provider Description',
                    'format' => 'richhtml'
                ))
                ->add('available')
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
                ->add('title', null, array('label' => 'Provider Name'))
                ->add('available')
        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('picture', 'string', array('template' => 'SonataMediaBundle:MediaAdmin:list_image.html.twig'))
                ->addIdentifier('title', 'text', array('label' => 'Provider Name'))
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Provider Description'
                    )
                ))
                ->add('available', null, array('editable' => true))
                ->add('gallery')
                ->add('_action', 'actions', array(
                    'actions' => array(
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
        ;
    }

    public function prePersist($provider) {
        $this->preUpdate($provider);
    }

    public function preUpdate($provider) {
        $provider->setProducts($provider->getProducts());
    }

    public $supportsPreviewMode = true;

}
