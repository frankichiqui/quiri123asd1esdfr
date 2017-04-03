<?php

namespace Daiquiri\AdminBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DoctrineExtensionListener implements ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function onLateKernelRequest(GetResponseEvent $event) {
        $translatable = $this->container->get('gedmo.listener.translatable');
        $translatable->setTranslatableLocale($event->getRequest()->getLocale());
        $translatable->setDefaultLocale('es_es');
        $translatable->setTranslationFallback(true);

    }

    public function onConsoleCommand() {
        $this->container->get('gedmo.listener.translatable')
                ->setTranslatableLocale($this->container->get('translator')->getLocale());
    }

    public function onKernelRequest(GetResponseEvent $event) {
        $securityContext = $this->container->get('security.context', ContainerInterface::NULL_ON_INVALID_REFERENCE);
        if (null !== $securityContext && null !== $securityContext->getToken() && $securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $loggable = $this->container->get('gedmo.listener.loggable');
            $loggable->setUsername($securityContext->getToken()->getUsername());
        }

//        $ip = $event->getRequest()->getClientIp();
//        if (null !== $ip) {
//            $ipTraceable = $this->container->get('gedmo.listener.iptraceable');
//            $ipTraceable->setIpValue($ip);
//        }
//        
//        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) { 
//            $ip = $event->getRequest()->getClientIp();
//            if (null !== $ip) {
//                $ipTraceable = $this->container->get('gedmo.listener.iptraceable');
//                $ipTraceable->setIpValue($ip);
//            } 
//        }
    }

}
