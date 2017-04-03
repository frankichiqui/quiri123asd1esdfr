<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Daiquiri\AdminBundle\Entity;

class Validate {

    public static function startAndEndDate(\DateTime $startdate, \DateTime $enddate) {
        if (Validate::dateDifference($startdate, $enddate) > 0 && Validate::dateDifference($startdate, $enddate, '%R') == '+' && Validate::isMoreThanMinDate($startdate)) {
            return true;
        }
        return false;
    }

    public static function dateDifference(\DateTime $startdate, \DateTime $enddate, $differenceFormat = '%a') {

        $interval = $startdate->diff($enddate);
        //print "datediff".$interval->format($differenceFormat);
        return $interval->format($differenceFormat);
    }

    public static function datebirthDate(\DateTime $birthdate) {

        $today = (new \DateTime('today'));
        if ($birthdate < $today) {
            //print "More 1";
            return true;
        }
        //print "More false";
        return false;
    }

    public static function isMoreThanMinDate(\DateTime $startdate, $min_date = 3) {
        $today_more_min = (new \DateTime('today'))->modify('+' . $min_date . ' days');
        if ($startdate >= $today_more_min) {
            //print "More 1";
            return true;
        }
        //print "More false";
        return false;
    }

    public static function inRangeDate(\DateTime $date, \DateTime $startdate, \DateTime $enddate) {
        if ($date >= $startdate && $date <= $enddate) {
            return true;
        }
        return false;
    }

}
