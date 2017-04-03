<?php

namespace Daiquiri\ReservationBundle\Twig;

class SerializeExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('serialize', array($this, 'serializeFilter')),
        );
    }

    public function serializeFilter($str)
    {
        $serialize  = serialize($str);

        return $serialize;
    }

    public function getName()
    {
        return 'serialize_extension';
    }
}