<?php

namespace Daiquiri\AdminBundle\Entity;

/**
 * RentalHouseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RentalHouseRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function getRentalHouseByPolo($id_polo = null) {
         if(!$id_polo || $id_polo < 0){
             return new \Doctrine\Common\Collections\ArrayCollection();
         }
        $q = 'SELECT rh FROM DaiquiriAdminBundle:RentalHouse rh JOIN rh.zone z JOIN z.province p JOIN p.polos po WHERE po.id = ?1';
        $query = $this->getEntityManager()->createQuery($q);
        $query->setParameter(1, $id_polo);
        return $query->getResult();
        
    }
     public function getRentalHouseByProvice($id_province = null) {
         if(!$id_province ||  $id_province < 0){
             return new \Doctrine\Common\Collections\ArrayCollection();
         }
        $q = 'SELECT rh FROM DaiquiriAdminBundle:RentalHouse rh JOIN rh.zone z JOIN z.province p WHERE p.id = ?1';
        $query = $this->getEntityManager()->createQuery($q);
        $query->setParameter(1, $id_province);
        return $query->getResult();        
    }
}