<?php

// src/Acme/MainBundle/Document/RssBlock.php

namespace Daiquiri\AdminBundle\Block;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;

class InfoBlock extends BaseBlockService {

    public function __construct($name, \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating) {


        parent::__construct($name, $templating);
    }

    public function getName() {
        return 'info';
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver) {
        
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block) {
        
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block) {
        
    }
    

    public function execute(BlockContextInterface $blockContext, \Symfony\Component\HttpFoundation\Response $response = null) {



        return $this->renderPrivateResponse('DaiquiriAdminBundle:Block:info.html.twig', array(
                    'block' => $blockContext->getBlock(),
                    'context' => $blockContext,
                    'settings' => $blockContext->getSettings(),
        ));
    }

}
