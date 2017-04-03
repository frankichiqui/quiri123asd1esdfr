<?php

namespace Daiquiri\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class PromotionBlockAdmin extends AbstractAdmin {

    protected $baseRouteName = 'promotionblock';
    protected $baseRoutePattern = 'daiquiri/admin/promotionblock';

    protected function configureRoutes(RouteCollection $collection) {
        // All routes are removed
        //$collection->clear();
        $collection->add('form-create-promotion-block', 'promotion-block');
        $collection->add('create-promotion-block', 'create-promotion-block');
    }

   /*  protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null) {
      $menu->addChild(
      $this->trans('product.sidemenu.promotionblock'),
      array('route' => 'admin_sonata_form_create_promotion_block' )
      );
      } */
}
