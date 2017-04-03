<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockController extends Controller {

    public function getCampaignInBlockAction($number) {

        $em = $this->getDoctrine()->getManager();
        $block = $em->getRepository('DaiquiriAdminBundle:Block')->findOneBy(array('number' => $number));
        $campaings = array();
        if ($block) {

            $current_market = $this->get('market')->getCurrentMarketAction();
            $today = new \DateTime('today');
            $campaings = $this->getDoctrine()->getEntityManager()->createQuery('SELECT c FROM DaiquiriAdminBundle:Campaign c JOIN c.block b JOIN c.markets m WHERE b.id = :block_id AND c.available = TRUE AND b.visible = TRUE AND :today BETWEEN c.showstartdate AND c.showenddate AND m.title = :current_market')
                    ->setParameter('block_id', $block->getId())
                    ->setParameter('today', $today)
                    ->setParameter('current_market', $current_market['title'])
                    ->getResult();
            
            if (count($campaings) == 0) {
                return new Response();
            }

            return $this->render('DaiquiriSiteBundle:Block:' . $number . '.html.twig', array(
                        'campaigns' => $campaings,
                        'block' => $block,
            ));
        }
        return new Response();
    }

}
