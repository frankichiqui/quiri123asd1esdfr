<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Daiquiri\ReservationBundle\Entity\Sale;
use Daiquiri\SiteBundle\Form\SaleType;
use Symfony\Component\HttpFoundation\Request;

class SaleController extends Controller {

    public function shoppingCartDetailAction() {
        
        $this->getRequest()->request->set('front', 1);
        $em = $this->getDoctrine()->getManager();
        $cart = $this->get('reservation.cartitem')->getArrayCartAction($this->getRequest(), $em);
        $sale = new \Daiquiri\ReservationBundle\Entity\Sale();
        $sale->setClient($this->getUser());
        foreach ($cart as $item) {
            $s = new \Daiquiri\ReservationBundle\Entity\Service();
            $paxs = $item->getArrayPaxs();
            for ($i = 0; $i < count($paxs); $i++) {
                $s->addServicepax(new \Daiquiri\ReservationBundle\Entity\ServicePax());
            }
            $sale->addService($s);
        }


        $form = $this->get('admin.sale')->getForm();

        $view_render = $this->getRequest()->get('view_render', 'DaiquiriSiteBundle:Default:cart.html.twig');

        $this->getRequest()->request->set('_sonata_admin', 'admin.sale');
        $admin = $this->get('admin.sale');
        return $this->render($view_render, array(
                    'admin' => $admin,
                    'form' => $form->setData($sale)->createView(),
                    'cart' => $cart,
                    'action' => 'create',
                    'sale' => $sale,
        ));
    }

}
