<?php

namespace Daiquiri\ReservationBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;

class GenerateOrderIdToSale {

    public function postPersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof \Daiquiri\ReservationBundle\Entity\Sale) {
            $id = $entity->getId();
            $reserve_id = $id + 1000;
            $reserve_id = $reserve_id . "DQ";
            $entity->setOrderid($reserve_id);          
            $entityManager->persist($entity);
            $entityManager->flush();
        }
        if ($entity instanceof \Daiquiri\AdminBundle\Entity\Payment) {
            $id = $entity->getId();
            $reserve_id = $id + 1000;
            $reserve_id = $reserve_id . "PY";
            $entity->setOrderId($reserve_id);            
            $entityManager->persist($entity);
            $entityManager->flush();
        }

        return;
    }

    

}
