<?php

namespace Daiquiri\AdminBundle\Entity;

/**
 * CarAvailabilityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarAvailabilityRepository extends \Doctrine\ORM\EntityRepository {

    function findByAvailabilityByCarAndDateRange($car, $startdate, $enddate) {
        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($startdate, $interval, $enddate->modify('+1 day'));
        foreach ($daterange as $date) {
            if (!$car->isAvailableInDate($date)){
                return false;
            }            
        }
        return true;
    }

}