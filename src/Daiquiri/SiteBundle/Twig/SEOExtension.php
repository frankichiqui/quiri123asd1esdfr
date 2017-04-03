<?php

namespace Daiquiri\SiteBundle\Twig;

class SEOExtension extends \Twig_Extension {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function getFunctions() {
        return array(
            'title' => new \Twig_Function_Method($this, 'title'),
            'seo_entity_title' => new \Twig_Function_Method($this, 'seo_entity_title'),
            'seo_entity_description' => new \Twig_Function_Method($this, 'seo_entity_description'),
            'seo_keywords' => new \Twig_Function_Method($this, 'seo_keywords'),
            'seo_description' => new \Twig_Function_Method($this, 'seo_description'),
            'nl2p' => new \Twig_Function_Method($this, 'nl2p'),
            'nl2s' => new \Twig_Function_Method($this, 'nl2s'),
            'bread_crumb' => new \Twig_Function_Method($this, 'bread_crumb'),
        );
    }

    public function title($url) {
        if ($url == "/") {
            return "";
        } else {

            $title = substr($url, 4);
            //print_r($title);die;
            $title = preg_replace("/\//", " ", $title);
            $title = preg_replace("/-/", " ", $title);
            $title = rtrim($title, ': ');
            $title = mb_convert_case($title, MB_CASE_TITLE, "UTF-8");
            return $title;
        }
    }

    public function bread_crumb($url) {
        //$request = $this->container->get('request');         
        if ($url == "/") {
            return "";
        } else {

            $title = substr($url, 4);
            $title = mb_convert_case($title, MB_CASE_TITLE, "UTF-8");
            $title = explode('/', $title);
            $bread_crumb = array();
            $bread_crumb[] = array('title' => 'Home', 'url' => 'daiquiri_site_homepage1');
            for ($i = 0; $i < count($title) - 1; $i++) {
                if ($title[$i] == 'Transfers') {
                    $bread_crumb[] = array('title' => $title[$i], 'url' => 'transfer_list');
                } elseif ($title[$i] == 'Hotels') {
                    $bread_crumb[] = array('title' => $title[$i], 'url' => 'hotel_list');
                } elseif ($title[$i] == 'Excursions') {
                    $bread_crumb[] = array('title' => $title[$i], 'url' => 'excursion_list');
                } elseif ($title[$i] == 'Circuits') {
                    $bread_crumb[] = array('title' => $title[$i], 'url' => 'circuit_list');
                } elseif ($title[$i] == 'Rentals') {
                    $bread_crumb[] = array('title' => $title[$i], 'url' => 'rental_list');
                } elseif ($title[$i] == 'Cars') {
                    $bread_crumb[] = array('title' => $title[$i], 'url' => 'car_list');
                } else {
                    $bread_crumb[] = array('title' => $title[$i], 'url' => '#');
                }
            }
            return $bread_crumb;
        }
    }

    public function seo_entity_title($title) {
        return $title;
    }

    public function seo_entity_description($description) {
        return $description;
    }

    public function seo_keywords($productType) {
        $repository = $this->em->getRepository('DaiquiriAdminBundle:ProductSeo');
        $product = $repository->findOneByProductType($productType);
        if (!$product) {
            return -1;
        } else {
            return $product->getKeywords();
        }
    }

    public function seo_description($productType) {
        $repository = $this->em->getRepository('DaiquiriAdminBundle:ProductSeo');
        $product = $repository->findOneByProductType($productType);
        if (!$product) {
            return -1;
        } else {
            return $product->getDescription();
        }
    }

    public function nl2s($string) {
        $paragraphs = '';
        foreach (explode("\n", $string) as $key => $line) {
            if (trim($line)) {
                if ($key === 2) {
                    echo $key;
                    $paragraphs .= '<span class="booking-item-review-more"><p>' . $line . '</p></span>';
                } else {
                    $paragraphs .= '<p>' . $line . '</p>';
                }
            }
        }
        return $paragraphs;
        die;
    }

    public function nl2p($string) {
        $paragraphs = '';

        foreach (explode("\n", $string) as $line) {
            if (trim($line)) {
                $paragraphs .= '<p>' . $line . '</p>';
            }
        }

        return $paragraphs;
    }

    public function getName() {
        return 'seo_extension';
    }

}
