<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductSeoAdmin extends AbstractAdmin {

    protected function configureFormFields(FormMapper $formMapper) {

        $em = $this->modelManager->getEntityManager('Daiquiri\AdminBundle\Entity\Product');

        $qb = $em->createQueryBuilder();
        $qb = $qb->add('select', 'p.productType')
                ->add('from', 'Daiquiri\AdminBundle\Entity\Product p');

        $query = $qb->getQuery();
        $result = $query->getArrayResult();
        $productType = array();

        foreach ($result as $res) {
            foreach ($res as $r) {
                $productType[$r] = trim($r);
            }
        }
        $formMapper
                ->add('productType', 'choice', array('choices' => $productType))
                ->add('keywords', null, array('label' => 'Keywords values can be separated using "," (e.g., beach,hotel,pool)'))
                ->add('description', 'sonata_simple_formatter_type', array(
                    'label' => 'Description',
                    'format' => 'richhtml',
                    'required' => false
                ))

        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('keywords')
                ->add('productType')
                ->add('description')

        ;
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->addIdentifier('productType')
                ->add('keywords')
                ->add('description', 'html', array(
                    'truncate' => array(
                        'separator' => ' ...',
                        'label' => 'Description'
            )))
        ;
    }

    public $supportsPreviewMode = true;

    function superUnique($array) {
        $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

        foreach ($result as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->superUnique($value);
            }
        }

        return $result;
    }

}
