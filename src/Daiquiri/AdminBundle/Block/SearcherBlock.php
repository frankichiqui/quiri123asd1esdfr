<?php

// src/Acme/MainBundle/Document/RssBlock.php

namespace Daiquiri\AdminBundle\Block;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;

class SearcherBlock extends BaseBlockService {

    private $doctrine;
    private $hotel;
    private $excursion;
    private $circuit;
    private $rentalhouse;
    private $car;
    private $transfer;
   

    public function __construct($name, \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating, \Symfony\Bridge\Doctrine\RegistryInterface $doctrine) {
        $this->doctrine = $doctrine;
        $this->hotel = true;
        $this->excursion = true;
        $this->circuit = true;
        $this->rentalhouse = true;
        $this->car = true;
        $this->transfer = true;
        

        parent::__construct($name, $templating);
    }

    public function getName() {
        return 'searcher';
    }

    public function setDefaultSettings(OptionsResolverInterface $resolver) {
        
    }

    public function buildEditForm(FormMapper $formMapper, BlockInterface $block) {
        $formMapper
                ->add('settings', 'sonata_type_immutable_array', array(
                    'keys' => array(
                        array('hotel', 'boolean', array('required' => false)),
                        array('excursion', 'boolean', array('required' => false)),
                        array('circuit', 'boolean', array('required' => false)),
                        array('rentalhouse', 'boolean', array('required' => false)),
                        array('transfer', 'boolean', array('required' => false)),
                        array('car', 'boolean', array('required' => false)),
                    )
                ))
        ;
    }

    public function validateBlock(ErrorElement $errorElement, BlockInterface $block) {
        
    }

    public function execute(BlockContextInterface $blockContext, \Symfony\Component\HttpFoundation\Response $response = null) {
        return $this->renderPrivateResponse('DaiquiriAdminBundle:Block:searcher.html.twig', array(
                    'hotel' => $this->hotel,
                    'excursion' => $this->excursion,
                    'circuit' => $this->circuit,
                    'rentalhouse' => $this->rentalhouse,
                    'transfer' => $this->transfer,
                    'car' => $this->car,                    
                    'block' => $blockContext->getBlock(),
                    'context' => $blockContext,
                    'settings' => $blockContext->getSettings()
        ));
    }

}
