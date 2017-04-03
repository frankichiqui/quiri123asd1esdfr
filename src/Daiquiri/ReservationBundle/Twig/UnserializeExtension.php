<?php

namespace Daiquiri\ReservationBundle\Twig;

class UnserializeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('unserialize', array($this, 'unserializeFilter')),
        );
    }

    public function unserializeFilter($str)
    {
        $unserialize  = unserialize($str);

        return $unserialize;
    }

    public function getName()
    {
        return 'unserialize_extension';
    }
}