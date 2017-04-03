<?php

namespace Daiquiri\ReservationBundle\Twig;

class PriceExtension extends \Twig_Extension {

    protected $doctrine;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Request
     */
    protected $request;

    public function __construct(\Symfony\Bridge\Doctrine\RegistryInterface $doctrine, \Symfony\Component\DependencyInjection\Container $container) {
        $this->doctrine = $doctrine;
        $this->container = $container;
        if ($this->container->isScopeActive('request')) {
            $this->request = $this->container->get('request');
        }
    }

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter'), array('is_safe' => array('html'))),
        );
    }

    public function priceFilter($number) {
        $increment_market = $this->getMarketIncrement();
        $change = $this->getCurrencyChange();        
        $number = ($change->getChange() * $number) * ( 1 + ($increment_market / 100));
        $price = number_format($number, 2, ".", ",");
        return '<i class="fa ' . $change->getFavicon() . '"></i> ' . $price;
        // Now you can do $this->doctrine->getRepository('TennisconnectUserBundle:User')
        // Rest of twig extension
    }

    public function getLogger() {
        return $this->container->get('logger');
    }

    public function getName() {
        return 'price_extension';
    }

    public function getDefaultMarket() {
        return $this->container->get('market')->getDefaultMarket();
    }

    public function getMarketIncrement() {
        return $this->container->get('market')->getMarketIncrement();
    }

    public function getCurrencyChange() {
        $session = $this->request->getSession();
        $nomenclator = $session->get('currency', 'usd');
        if (!$nomenclator) {
            $session->set('currency', 'usd');
            $nomenclator = $session->get('currency');
        }
        $change = $this->doctrine->getRepository('DaiquiriAdminBundle:Currency')->findOneByNomenclator($nomenclator);
        if (!$change) {
            $change = new \Daiquiri\AdminBundle\Entity\Currency();
            $change->setChange(1);
            $change->setFavicon('fa-dollar');
            $change->setNomenclator('usd');
            $change->setTitle('Dollar');
            $this->doctrine->getEntityManager()->persist($change);
            $this->doctrine->getEntityManager()->flush();
        }
        return $change;
    }

}
