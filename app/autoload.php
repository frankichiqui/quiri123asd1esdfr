<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';
//$loader->add('Application',realpath(__DIR__.'/../src'));
//$loader->add('Daiquiri',realpath(__DIR__.'/../src'));
//$loader->add('Sonata',realpath(__DIR__.'/../vendor'));



AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
