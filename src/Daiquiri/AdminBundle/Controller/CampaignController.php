<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\Form\FormBuilder;
use \Symfony\Component\HttpFoundation\Response;
use \Doctrine\Common\Collections\Collection;
use \Doctrine\ORM\EntityRepository;


/**
 * Campaign controller.
 *
 */
class CampaignController extends Controller {

    public function getCampaignInBlockAction($number, $view = null) {

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
           
            return $this->render($view, array(
                        'campaigns' => $campaings
            ));
        }
        return $this->render($view, array('campings' => null));
    }

}
