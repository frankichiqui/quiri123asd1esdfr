<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
       
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //para las traduccionesde las rutas
            //new BeSimple\I18nRoutingBundle\BeSimpleI18nRoutingBundle(),
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new WhiteOctober\TCPDFBundle\WhiteOctoberTCPDFBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            // These are the other bundles the SonataAdminBundle relies on
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\ClassificationBundle\SonataClassificationBundle(),
            new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            // And finally, the storage and SonataAdminBundle
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            //Sonata Formatter's Bundle
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sonata\FormatterBundle\SonataFormatterBundle(),
            // extend the "FOSUserBundle"
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new Daiquiri\SiteBundle\DaiquiriSiteBundle(),
            new Daiquiri\ReservationBundle\DaiquiriReservationBundle(),
            new Daiquiri\AdminBundle\DaiquiriAdminBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            //sonataproject SEO Bundle            
            new Sonata\SeoBundle\SonataSeoBundle(),
            //FOSCommentBundle y Sonata Project Comment Bundle
            new FOS\RestBundle\FOSRestBundle(),

            //login social
            new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            //para el paginado 
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            //para traducciones
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\AopBundle\JMSAopBundle(),
            //new A2lix\AutoFormBundle\A2lixAutoFormBundle(),
            //new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(),
        );
        //prueba

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
