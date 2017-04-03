<?php

namespace Daiquiri\ReservationBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ConfigurationPamAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
                ->add('title')
                ->add('companyName')
                ->add('tax')
                ->with('Block Euro', array('class' => 'col-md-3'))
                ->add('keyPamEur')
                ->add('codePamEur')
                ->end()
                ->with('Block USD', array('class' => 'col-md-3'))
                ->add('keyPamUsd')
                ->add('codePamUsd')
                ->end()
                ->with('Block Comercio', array('class' => 'col-md-3'))
                ->add('comercio')
                ->end()
                ->with('Block URL', array('class' => 'col-md-3'))
                ->add('pasarela')
                ->add('absoluteDir')
                ->add('urlRecive')
                ->add('urlOk')
                ->add('urlKo')
                ->end()

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('keyPamEur')
                ->add('codePamEur')
                ->add('keyPamUsd')
                ->add('codePamUsd')
                ->add('comercio')
                ->add('pasarela')
                ->add('absoluteDir')
                ->add('urlRecive')
                ->add('urlOk')
                ->add('urlKo')

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('title')
                ->add('companyName')
                ->add('tax')
                ->add('keyPamEur', null, array('editable' => true))
                ->add('codePamEur', null, array('editable' => true))
                ->add('keyPamUsd', null, array('editable' => true))
                ->add('codePamUsd', null, array('editable' => true))
                ->add('comercio', null, array('editable' => true))
                ->add('pasarela', null, array('editable' => true))
                ->add('absoluteDir', null, array('editable' => true))
                ->add('urlRecive', null, array('editable' => true))
                ->add('urlOk', null, array('editable' => true))
                ->add('urlKo', null, array('editable' => true))


        ;
    }

    public $supportsPreviewMode = true;

}
