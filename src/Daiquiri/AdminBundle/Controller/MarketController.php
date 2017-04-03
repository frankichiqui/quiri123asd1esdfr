<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;

/**
 * Market controller.
 *
 */
class MarketController extends Controller {

    protected $doctrine;
    protected $request;

    public function __construct(\Symfony\Bridge\Doctrine\RegistryInterface $doctrine, \Symfony\Component\DependencyInjection\Container $container) {
        $this->doctrine = $doctrine;
        $this->container = $container;
        if ($this->container->isScopeActive('request')) {
            $this->request = $this->container->get('request');
        }
    }

    public function getAllMarketAction() {
        //return new \Symfony\Component\HttpFoundation\Response(json_encode(array()));
        $em = $this->doctrine->getManager();
        $markets = $em->getRepository("DaiquiriAdminBundle:Market")->findAll();
        $all = array();
        $salida = array();
        $current = $this->getCurrentMarketAction();
        if (count($markets) > 0) {
            foreach ($markets as $value) {
                $all[] = array(
                    'title' => $value->getTitle(),
                    'increment' => $value->getIncrement(),
                );
            }
            $salida['current_title'] = $current['title'];
            $salida['current_increment'] = $current['increment'];
            $salida['all'] = $all;

            return new \Symfony\Component\HttpFoundation\Response(json_encode($salida));
        } else {
            $all = array(
                'title' => $current->getTitle(),
                'increment' => $current->getIncrement(),
            );
            $salida['current_title'] = $current['title'];
            $salida['current_increment'] = $current['increment'];
            $salida['all'] = $all;
            return new \Symfony\Component\HttpFoundation\Response(json_encode($salida));
        }
    }

    public function getCurrentMarketAction() {
        $session = $this->request->getSession();
        $em = $this->doctrine->getManager();
        $a = $session->get('market');
        if (!$a) {
            $this->get('logger')->addInfo('-----------no hay nada market en la session ');
            $ip = $this->request->getClientIp();

            $dir_ipapi = $this->getParameter('ip_api_test');
            $response_array = @unserialize(file_get_contents($dir_ipapi));
//            
//            $dir_ipapi = $this->getParameter('ip_api');
//            $response_array = @unserialize(file_get_contents($dir_ipapi . $ip));
            if ($response_array['status'] == 'success') {
                $this->get('logger')->addInfo('-----------pedi el ip y me respondio ' . $response_array['countryCode']);
                $this->get('logger')->addInfo('----------status success ' . $response_array['countryCode']);
                $iso_code = $response_array['countryCode'];
                $country = $this->doctrine->getRepository('DaiquiriAdminBundle:Country')->findOneBy(array('isoCode' => $iso_code));
                if ($country) {
                    $this->get('logger')->addInfo('----------hay country ' . $response_array['countryCode']);
                    if ($country->getMarket()) {
                        $this->get('logger')->addInfo('----------------hay market ' . $response_array['countryCode']);
                        $market = $country->getMarket();
                        $session->set('market', array('title' => $country->getMarket()->getTitle()));
                        $session->set('data_ip', $response_array);
                        $salida = array('title' => $market->getTitle(), 'increment' => $market->getIncrement());
                        return $salida;
                    } else {
                        $this->get('logger')->addInfo('--------- no hay market ' . $response_array['countryCode']);
                        $m_default = $this->getDefaultMarket();
                        $m_default->addCountry($country);
                        $em->persist($m_default);
                        $em->flush();

                        $session->set('market', array('title' => $m_default->getTitle()));
                        $session->set('data_ip', $response_array);
                        $salida = array('title' => $m_default->getTitle(), 'increment' => $m_default->getIncrement());
                        return $salida;
                    }
                } else {
                    $this->get('logger')->addInfo('--------- no hay country ' . $response_array['countryCode']);
                    $c = new \Daiquiri\AdminBundle\Entity\Country();
                    $c->setIsoCode($response_array['countryCode']);
                    $c->setTitle($response_array['country']);
                    $default = $this->getDefaultMarket();
                    $default->addCountry($c);
                    $em->persist($default);
                    $em->persist($c);
                    $em->flush();
                    $session->set('market', array('title' => $default->getTitle()));
                    $session->set('data_ip', $response_array);
                    $salida = array('title' => $default->getTitle(), 'increment' => $default->getIncrement());
                    return $salida;
                }
            } else {
                $this->get('logger')->addInfo('----------success false para el response ' . $response_array['status']);
                $default = $this->getDefaultMarket();
                $session->set('market', array('title' => $default->getTitle()));
                $session->set('data_ip', array());
                $salida = array('title' => $default->getTitle(), 'increment' => $default->getIncrement());
                return $salida;
            }
        } else {
            $this->get('logger')->addInfo('----------- hay algo market en la session ');
            $marketobj = $em->getRepository("DaiquiriAdminBundle:Market")->findOneBy(array('title' => $a['title']));
            if (!$marketobj) {
                $marketobj = $this->getDefaultMarket();
            }
            $salida = array('title' => $marketobj->getTitle(), 'increment' => $marketobj->getIncrement());
            return $salida;
        }
    }

    public function setCurrentMarketAction($market) {
        $em = $this->doctrine->getManager();
        $marketobj = $em->getRepository("DaiquiriAdminBundle:Market")->findOneBy(array('title' => $market));
        if ($marketobj) {
            $this->request->getSession()->set('market', array('title' => strtoupper($marketobj->getTitle())));
            if ($this->request->isXmlHttpRequest()) {
                return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true, 'new' => $marketobj->getTitle())));
            } else {
                return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true, 'new' => $marketobj->getTitle())));
            }
        }
        return new \Symfony\Component\HttpFoundation\Response(json_encode(array('success' => true, 'new' => 'not found market with title ' . $market)));
    }

    public function getDefaultMarket() {
        $default = $this->doctrine->getEntityManager()->getRepository('DaiquiriAdminBundle:Market')->findOneByTitle('DEFAULT');
        if ($default) {
            $this->request->getSession()->set('market', array(
                'title' => strtoupper($default->getTitle())
            ));
            return $default;
        }
        $default = new \Daiquiri\AdminBundle\Entity\Market();
        $default->setIncrement(0);
        $default->setTitle('DEFAULT');
        $this->doctrine->getManager()->persist($default);
        $this->doctrine->getManager()->flush();
        $this->request->getSession()->set('market', array(
            'title' => strtoupper($default->getTitle())
        ));

        return $default;
    }

    public function getObject() {
        $em = $this->doctrine->getManager();
        $title = $this->getCurrentMarketAction()['title'];
        $marketobj = $em->getRepository("DaiquiriAdminBundle:Market")->findOneBy(array('title' => $title));
        return $marketobj;
    }

    public function getMarketIncrement() {
        $em = $this->doctrine->getManager();
        $session = $this->request->getSession();
        $a = $this->request->getSession()->get('market');
        if (!$a) {
            $this->get('logger')->addInfo('-----------no hay nada market en la session ');
            $ip = $this->request->getClientIp();

            $dir_ipapi = $this->container->getParameter('ip_api_test');
            $response_array = @unserialize(file_get_contents('http://localhost/prueba/php/index2.php'));
//            $dir_ipapi = $this->container->getParameter('ip_api');//
//            $response_array = @unserialize(file_get_contents($dir_ipapi . $ip));
            $this->get('logger')->addInfo('-----------pedi el ip y me respondio ' . $response_array['countryCode']);
            if ($response_array['status'] == 'success') {
                $this->get('logger')->addInfo('----------status success ' . $response_array['countryCode']);
                $iso_code = $response_array['countryCode'];
                $country = $em->getRepository('DaiquiriAdminBundle:Country')->findOneBy(array('isoCode' => $iso_code));
                if ($country) {
                    $this->get('logger')->addInfo('----------hay country ' . $response_array['countryCode']);
                    if ($country->getMarket()) {
                        $this->get('logger')->addInfo('----------------hay market ' . $response_array['countryCode']);
                        $market = $country->getMarket();
                        $session->set('market', array('title' => $country->getMarket()->getTitle()));
                        $session->set('data_ip', $response_array);
                        $salida = array('title' => $market->getTitle(), 'increment' => $market->getIncrement());
                        return $salida['increment'];
                    } else {
                        $this->get('logger')->addInfo('--------- no hay market ' . $response_array['countryCode']);
                        $m_default = $this->getDefaultMarket();
                        $m_default->addCountry($country);
                        $em->persist($m_default);
                        $em->flush();

                        $session->set('market', array('title' => $m_default->getTitle()));
                        $session->set('data_ip', $response_array);
                        $salida = array('title' => $m_default->getTitle(), 'increment' => $m_default->getIncrement());
                        return $salida['increment'];
                    }
                } else {
                    $this->get('logger')->addInfo('--------- no hay country ' . $response_array['countryCode']);
                    $c = new \Daiquiri\AdminBundle\Entity\Country();
                    $c->setIsoCode($response_array['countryCode']);
                    $c->setTitle($response_array['country']);
                    $default = $this->getDefaultMarket();
                    $default->addCountry($c);
                    $em->persist($default);
                    $em->persist($c);
                    $em->flush();
                    $session->set('market', array('title' => $default->getTitle()));
                    $session->set('data_ip', $response_array);
                    $salida = array('title' => $default->getTitle(), 'increment' => $default->getIncrement());
                    return $salida['increment'];
                }
            } else {
                $this->get('logger')->addInfo('----------success false para el response ' . $response_array['success']);
                $default = $this->getDefaultMarket();
                $session->set('market', array('title' => $default->getTitle()));
                $session->set('data_ip', array());
                $salida = array('title' => $default->getTitle(), 'increment' => $default->getIncrement());
                return $salida['increment'];
            }
        } else {
            $this->get('logger')->addInfo('----------- hay algo market en la session ');
            $marketobj = $em->getRepository("DaiquiriAdminBundle:Market")->findOneBy(array('title' => $a['title']));
            if (!$marketobj) {
                $marketobj = $this->getDefaultMarket();
            }
            $salida = array('title' => $marketobj->getTitle(), 'increment' => $marketobj->getIncrement());
            return $salida['increment'];
        }
    }

}
