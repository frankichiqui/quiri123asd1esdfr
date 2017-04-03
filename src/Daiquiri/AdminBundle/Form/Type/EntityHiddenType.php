<?php
namespace Daiquiri\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Daiquiri\AdminBundle\Form\DataTransformer\EntityToIdTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Common\Persistence\ObjectManager;

class EntityHiddenType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new EntityToIdTransformer($this->objectManager, $options['class']);
        $builder->addModelTransformer($transformer);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(array('class'))
            ->setDefaults(array(
                'invalid_message' => 'The entity does not exist.',
            ))
        ;
    }
    public function getParent()
    {
        return 'hidden';
    }
    public function getName()
    {
        return 'entity_hidden';
    }
}