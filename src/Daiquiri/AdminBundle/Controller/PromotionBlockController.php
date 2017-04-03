<?php

namespace Daiquiri\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Controller\CRUDController as SonataCRUDController;
use \Symfony\Component\Form\FormBuilder;
use Daiquiri\AdminBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

/**
 * TransferColective controller.
 *
 */
class PromotionBlockController extends SonataCRUDController {

    public function formCreatePromotionBlockAction() {

        $form = $this->formCreatePromotionBlockForm();
        return $this->render('DaiquiriAdminBundle:PromotionBlock:promotionblock.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function listAction() {
        return $this->formCreatePromotionBlockAction();
    }

    public function createPromotionBlockAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->formCreatePromotionBlockForm();
        $form->handleRequest($request);


        if ($form->isValid()) {
            $data = $form->getData();

            if (count($data['promotionSlide']) < 1 && count($data['promotionBlockOne']) < 1 && count($data['promotionBlockTwo']) < 1 && count($data['promotionBlockThree']) < 1 && count($data['promotionBlockFour']) < 1) {

                $this->removeAllPromotedBlockProduct();
                $this->addFlash('sonata_flash_success', 'The promotion options have been created successfully');
                return $this->redirect($this->admin->generateUrl('form-create-promotion-block'));
            }

            if (count($data['promotionSlide']) < 1) {
                $this->removePromotionSlide();
            } else {
                $this->removePromotionSlide();
                foreach ($data['promotionSlide'] as $slide) {
                    $product = $em->getRepository('DaiquiriAdminBundle:Product')->findOneById($slide->getId());
                    if ($product) {
                        $product->setPromotionSlide(true);
                        $em->persist($product);
                        $em->flush();
                    }
                }
            }
            if (count($data['promotionBlockOne']) < 1) {
                $this->removePromotedBlockOne();
            } else {
                $this->removePromotedBlockOne();
                foreach ($data['promotionBlockOne'] as $one) {
                    $product = $em->getRepository('DaiquiriAdminBundle:Product')->findOneById($one->getId());
                    if ($product) {
                        $product->setPromotionBlockOne(true);
                        $em->persist($product);
                        $em->flush();
                    }
                }
            }
            if (count($data['promotionBlockTwo']) < 1) {
                $this->removePromotedBlockTwo();
            } else {
                $this->removePromotedBlockTwo();
                foreach ($data['promotionBlockTwo'] as $two) {
                    $product = $em->getRepository('DaiquiriAdminBundle:Product')->findOneById($two->getId());
                    if ($product) {
                        $product->setPromotionBlockTwo(true);
                        $em->persist($product);
                        $em->flush();
                    }
                }
            }
            if (count($data['promotionBlockThree']) < 1) {
                $this->removePromotedBlockThree();
            } else {
                $this->removePromotedBlockThree();
                foreach ($data['promotionBlockThree'] as $three) {
                    $product = $em->getRepository('DaiquiriAdminBundle:Product')->findOneById($three->getId());
                    if ($product) {
                        $product->setPromotionBlockThree(true);
                        $em->persist($product);
                        $em->flush();
                    }
                }
            }
            if (count($data['promotionBlockFour']) < 1) {
                $this->removePromotedBlockFour();
            } else {
                $this->removePromotedBlockFour();

                foreach ($data['promotionBlockFour'] as $four) {
                    $product = $em->getRepository('DaiquiriAdminBundle:Product')->findOneById($four->getId());
                    if ($product) {
                        $product->setPromotionBlockFour(true);
                        $em->persist($product);
                        $em->flush();
                    }
                }
            }
            $this->addFlash('sonata_flash_success', 'The promotion options have been created successfully');
            return $this->redirect($this->admin->generateUrl('form-create-promotion-block'));
        }

        $this->addFlash('sonata_flash_error', ' The data is not valid please check this.');
        return $this->redirect($this->admin->generateUrl('form-create-promotion-block'));
    }

    private function formCreatePromotionBlockForm() {
        $form = $this->createFormBuilder(
                        array(), array(), array())
                ->add('promotionSlide', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true,
                    'label' => 'Promotion Main Slide',
                    'data' => $this->getPromotedMainSlide(),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->where('u.productType != :productType')
                                ->setParameter('productType', 'Ocupation');
                    }
                ))
                ->add('promotionBlockOne', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true,
                    'label' => 'Promotion Block One',
                    'data' => $this->getPromotedBlockOne(),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->where('u.productType != :productType')
                                ->setParameter('productType', 'Ocupation');
                    }
                ))
                ->add('promotionBlockTwo', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true,
                    'label' => 'Promotion Block Two',
                    'data' => $this->getPromotedBlockTwo(),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->where('u.productType != :productType')
                                ->setParameter('productType', 'Ocupation');
                    }
                ))
                ->add('promotionBlockThree', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true,
                    'label' => 'Promotion Block Three',
                    'data' => $this->getPromotedBlockThree(),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->where('u.productType != :productType')
                                ->setParameter('productType', 'Ocupation');
                    }
                ))
                ->add('promotionBlockFour', 'genemu_jqueryselect2_entity', array(
                    'class' => 'Daiquiri\AdminBundle\Entity\Product',
                    'property' => 'title',
                    'required' => false,
                    'multiple' => true,
                    'label' => 'Promotion Block Four',
                    'data' => $this->getPromotedBlockFour(),
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                                ->where('u.productType != :productType')
                                ->setParameter('productType', 'Ocupation');
                    }
                ))
                ->getForm();
        return $form;
    }

    public function getPromotedMainSlide() {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p FROM DaiquiriAdminBundle:Product p WHERE p.promotionSlide = TRUE');
        return $query->getResult();
    }

    public function getPromotedBlockOne() {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p FROM DaiquiriAdminBundle:Product p WHERE p.promotionBlockOne = TRUE');
        return $query->getResult();
    }

    public function getPromotedBlockTwo() {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p FROM DaiquiriAdminBundle:Product p WHERE p.promotionBlockTwo = TRUE');
        return $query->getResult();
    }

    public function getPromotedBlockThree() {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p FROM DaiquiriAdminBundle:Product p WHERE p.promotionBlockThree = TRUE');
        return $query->getResult();
    }

    public function getPromotedBlockFour() {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p FROM DaiquiriAdminBundle:Product p WHERE p.promotionBlockFour = TRUE');
        return $query->getResult();
    }

    public function removeAllPromotedBlockProduct() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('DaiquiriAdminBundle:Product')->findAll();
        foreach ($products as $product) {
            $product->setPromotionSlide(false);
            $product->setPromotionBlockOne(false);
            $product->setPromotionBlockTwo(false);
            $product->setPromotionBlockThree(false);
            $product->setPromotionBlockFour(false);
            $em->persist($product);
            $em->flush();
        }
    }

    public function removePromotionSlide() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('DaiquiriAdminBundle:Product')->findAll();
        foreach ($products as $product) {
            $product->setPromotionSlide(false);
            $em->persist($product);
            $em->flush();
        }
    }

    public function removePromotedBlockOne() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('DaiquiriAdminBundle:Product')->findAll();
        foreach ($products as $product) {
            $product->setPromotionBlockOne(false);
            $em->persist($product);
            $em->flush();
        }
    }

    public function removePromotedBlockTwo() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('DaiquiriAdminBundle:Product')->findAll();
        foreach ($products as $product) {
            $product->setPromotionBlockTwo(false);
            $em->persist($product);
            $em->flush();
        }
    }

    public function removePromotedBlockThree() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('DaiquiriAdminBundle:Product')->findAll();
        foreach ($products as $product) {
            $product->setPromotionBlockThree(false);
            $em->persist($product);
            $em->flush();
        }
    }

    public function removePromotedBlockFour() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('DaiquiriAdminBundle:Product')->findAll();
        foreach ($products as $product) {
            $product->setPromotionBlockFour(false);
            $em->persist($product);
            $em->flush();
        }
    }

}
