<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction($name) {
        return $this->render('DaiquiriAdminBundle:Default:index.html.twig', array('name' => $name));
    }

    public function getLocationAction(\Symfony\Component\HttpFoundation\Request $request) {
        $q = ($request->query->get('q', ''));
        $class = $request->query->get('class', 'Polo');
        $property = $request->query->get('property', 'title');

        $query = $this->getDoctrine()->getEntityManager()->createQuery('SELECT h FROM DaiquiriAdminBundle:' . $class . ' h WHERE UPPER(h.title) LIKE :q')
                ->setParameter('q', '%' . strtoupper($q) . '%');
        $hotels = $query->getResult();
        $sh = array();
        foreach ($hotels as $h) {
            $sh[] = array(
                'id' => $h->getId(),
                'title' => $h->getTitle(),
                'pic' => $this->container->get('sonata.media.twig.extension')->path($h->getPicture(), 'min64'),
                'type' => $class,
                'description' => substr($h->getDescription(), 0, 50) . ' ...',
            );
        }
        $response = json_encode(array(
            "status" => true,
            "error" => null,
            "data" => array(
                'location' => $sh,
            )
        ));
        return new \Symfony\Component\HttpFoundation\Response($response);
    }

    public function getAllCurrencyAction() {
        $em = $this->getDoctrine()->getManager();
        $currencys = $em->getRepository("DaiquiriAdminBundle:Currency")->findAll();
        if (count($currencys) > 0) {
            if ($this->getRequest()->isXmlHttpRequest()) {
                $salida = array();
                foreach ($currencys as $value) {
                    $salida[] = array(
                        'title' => $value->getTitle(),
                        'change' => $value->getChange(),
                        'nomenclator' => $value->getNomenclator(),
                        'favicon' => $value->getFavicon(),
                        'current' => ($value->getNomenclator() == $this->getRequest()->getSession()->get('currency', 'usd') ? true : false));
                }
                $response = new \Symfony\Component\HttpFoundation\Response(json_encode($salida));
                return $response;
            }
        }
        $usd = new \Daiquiri\AdminBundle\Entity\Currency();
        $usd->setChange(1);
        $usd->setFavicon('fa-dollar');
        $usd->setTitle("Dollar");
        $usd->setNomenclator('usd');
        $usd->setCode('840');
        $em->persist($usd);
        $em->flush();


        $salida[] = array(
            'title' => $usd->getTitle(),
            'change' => $usd->getChange(),
            'nomenclator' => $usd->getNomenclator(),
            'favicon' => $usd->getFavicon(),
            'current' => true);

        $response = new \Symfony\Component\HttpFoundation\Response(json_encode($salida));
        return $response;
    }

    public function getCurrencyActualyAction() {
        $a = $this->getRequest()->getSession()->get('currency', 'usd');
        $em = $this->getDoctrine()->getManager();
        $currency = $em->getRepository("DaiquiriAdminBundle:Currency")->findOneBy(array('nomenclator' => $a));

        if (!$currency && $a == 'usd') {
            $usd = new \Daiquiri\AdminBundle\Entity\Currency();
            $usd->setChange(1);
            $usd->setFavicon('fa-dollar');
            $usd->setTitle("USD");
            $usd->setNomenclator('usd');
            $usd->setCode('840');
            $em->persist($usd);
            $em->flush();
            $currency = $usd;
        }

        if ($currency) {
            if ($this->getRequest()->isXmlHttpRequest()) {
                $salida = array('title' => $currency->getTitle(), 'nomenclator' => $currency->getNomenclator(), 'favicon' => $currency->getFavicon());

                return new \Symfony\Component\HttpFoundation\Response(json_encode($salida));
            } else {
                return $currency;
            }
        }
        return new \Symfony\Component\HttpFoundation\Response();
    }
    
    public function getCurrentCurrencyAction(){
       $currency = $this->getRequest()->getSession()->get('currency');
       if(!$currency){
           $this->getRequest()->getSession()->set('currency', 'usd');
       }
       else{
           return $currency;
       }
    }

    public function setCurrentCurrencyAction($currency) {

        $em = $this->getDoctrine()->getManager();
        $currencyobj = $em->getRepository("DaiquiriAdminBundle:Currency")->findOneBy(array('nomenclator' => $currency));
        if ($currencyobj) {
            $this->getRequest()->getSession()->set('currency', $currency);
            if ($this->getRequest()->isXmlHttpRequest()) {
                return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true, 'new' => $currencyobj->getNomenclator())));
            } else {
                return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true, 'new' => $currencyobj->getNomenclator())));
            }
        }
        return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true, 'new' => 'not found curency with nomenclator ' . $currency)));
    }

    public function getAllMarketAction() {
        return $this->container->get('market')->getAllMarketAction();
    }

    public function getCurrentMarketAction() {
        return $this->container->get('market')->getCurrentMarketAction();
    }

    public function setCurrentMarketAction($market) {
        return $this->container->get('market')->setCurrentMarketAction($market);
    }

    public function getDefaultMarket() {
        return $this->container->get('market')->getDefaultMarket();
    }

    private function getSaleNotAtend() {
        $sales = $this->getDoctrine()->getManager()->getRepository('DaiquiriReservationBundle:Sale')->findAll();
        $not_atend_order = 0;
        foreach ($sales as $s) {
            if ($s->hasServiceWithStatusBySystem()) {
                $not_atend_order++;
            }
        }
        return $not_atend_order;
    }

    private function maxProductAction() {
        $q = 'SELECT p FROM DaiquiriAdminBundle:Product p where p.numbersales = (SELECT MAX(q.numbersales) FROM DaiquiriAdminBundle:Product q)';
        $result = $this->getDoctrine()->getEntityManager()->createQuery($q)->getResult();
        if (count($result) > 0) {
            return array(
                'product' => strtoupper($result[0]->getTitle()),
                'id' => $result[0]->getId(),
                'type' => $result[0]->getType(),
                'number' => $result[0]->getNumbersales()
            );
        }
        return array(
            'product' => "",
            'id' => 0,
            'type' => ""
        );
    }

    private function getAmountSalesAction() {
        $sales = $this->getDoctrine()->getManager()->getRepository('DaiquiriReservationBundle:Sale')->findAll();
        $amount = 0;
        foreach ($sales as $s) {
            $amount += $s->getAmountInUSD();
        }
        return $amount;
    }

    public function DataInfoBlockAction() {
        $not_atend_order = $this->getSaleNotAtend();


        $user = $this->getDoctrine()->getManager()->getRepository('DaiquiriAdminBundle:DUser')->findAll();
        $user_registration = count($user);

        $r = $this->getDoctrine()->getManager()->getRepository('DaiquiriReservationBundle:Request')->findAll();
        $request = count($r);



        $product_max = $this->maxProductAction();

        return new \Symfony\Component\HttpFoundation\Response(json_encode(array(
                    'success' => true,
                    'no_atend_order' => $not_atend_order,
                    'user' => $user_registration,
                    'request' => $request,
                    'product_max' => $product_max,
                    'amount_sales' => $this->getAmountSalesAction()
        )));
    }

}
