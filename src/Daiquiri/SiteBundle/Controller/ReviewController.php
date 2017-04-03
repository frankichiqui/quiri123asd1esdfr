<?php

namespace Daiquiri\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Daiquiri\AdminBundle\Entity\Review;
use Daiquiri\SiteBundle\Form\ReviewType;

/**
 * Review controller.
 *
 */
class ReviewController extends Controller {

    /**
     * Lists all Review entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DaiquiriAdminBundle:Review')->findAll();

        return $this->render('DaiquiriSiteBundle:Review:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Review entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Review();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setCreatedAt(new \DateTime('now'));
            $entity->setVotes($entity->getPositiveVotes() + $entity->getNegativeVotes());
            //dump($this->getUser());die;
            $entity->setUserReview($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $params = $this->getRequest()->request->all();
            return $this->redirect($this->generateUrl('hotel_details', array('slug' => $params['daiquiri_sitebundle_review']['entitySlug'])));
        }

        return $this->render('DaiquiriAdminBundle:Review:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Review entity.
     *
     * @param Review $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Review $entity) {
        $form = $this->createForm(new ReviewType(), $entity, array(
            'action' => $this->generateUrl('review_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Review entity.
     *
     */
    public function newAction() {
        $entity = new Review();
        $form = $this->createCreateForm($entity);

        return $this->render('DaiquiriAdminBundle:Review:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Review entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DaiquiriAdminBundle:Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DaiquiriSiteBundle:Review:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Review entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DaiquiriAdminBundle:Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DaiquiriSiteBundle:Review:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Review entity.
     *
     * @param Review $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Review $entity) {
        $form = $this->createForm(new ReviewType(), $entity, array(
            'action' => $this->generateUrl('review_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Review entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DaiquiriAdminBundle:Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('review_edit', array('id' => $id)));
        }

        return $this->render('DaiquiriSiteBundle:Review:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Review entity.
     *
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DaiquiriAdminBundle:Review')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Review entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('review'));
    }

    /**
     * Creates a form to delete a Review entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('review_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    public function getUser() {
        /* if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
          throw new AccessDeniedException();
          } */
        if (!$this->container->has('security.context')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.context')->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }

    public function setPositiveVoteAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DaiquiriAdminBundle:Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review entity.');
        }
       
            $entity->setPositiveVotes($entity->getPositiveVotes() + 1);
            $entity->setVotes($entity->getVotes() + 1);
            //$entity->addUsersVotes($this->getUser());
            $em->persist($entity);
            $em->flush();
            return new Response(json_encode(array('success' => true, 'positiveVotes' => $entity->getPositiveVotes())));
       
    }

    public function setNegativeVoteAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DaiquiriAdminBundle:Review')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Review entity.');
        }
       
            $entity->setNegativeVotes($entity->getNegativeVotes() + 1);
            $entity->setVotes($entity->getVotes() + 1);
            //$entity->addUsersVotes($this->getUser());
            $em->persist($entity);
            $em->flush();
            return new Response(json_encode(array('success' => true, 'negativeVotes' => $entity->getNegativeVotes())));
        
    }

    public function getVoteForUser($review) {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('DaiquiriAdminBundle:DUser')->findOneById($this->getUser()->getId());
        //dump($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DUser entity.');
        }

        $vote = $entity->getReview()->getId();
        if (!$vote) {
            throw $this->createNotFoundException('Unable to find votes for this Review entity.');
        }
        if ($vote == $review) {
            return True;
        } else {
            return false;
        }
    }

}
