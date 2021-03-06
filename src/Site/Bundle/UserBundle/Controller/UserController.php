<?php

namespace Site\Bundle\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\Bundle\UserBundle\Entity\User;
use Site\Bundle\UserBundle\Form\UserType;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiteUserBundle:User')->findAll();

        return $this->render('SiteUserBundle:User:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new User entity.
     *
     */
    public function createAction(Request $request)
    {
        $errorMsg = $msg= "";

        $entity = new User();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        try{

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('created', 'New User added successfully!');
                return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
            }

        }catch(\Exception $e){
            $msg="";
            $errorMsg .= "WARNING >> Updation Error :: ";
            $msg .= get_class($e). " >> ";
            $msg .= $e->getMessage();
            echo $errorMsg .= $msg;
        }

        return $this->render('SiteUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return $this->render('SiteUserBundle:User:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiteUserBundle:User:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $errorMsg = $msg= "";

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SiteUserBundle:User')->find($id);

        try{

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $editForm = $this->createEditForm($entity);
            $deleteForm = $this->createDeleteForm($id);

            return $this->render('SiteUserBundle:User:edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));

        }catch(\Exception $e){
            $msg="";
            $errorMsg .= "WARNING >> Editing Error :: ";
            $msg .= get_class($e). " >> ";
            $msg .= $e->getMessage();
            $errorMsg .= $msg;
        }

        $this->get('session')->getFlashBag()->add('showindex', $errorMsg);
        return $this->redirect($this->generateUrl('user'));

    }

    /**
    * Creates a form to edit a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $errorMsg = $msg= "";

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SiteUserBundle:User')->find($id);

        try{

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);

            if ($editForm->isValid()) {
                $em->flush();

                $this->get('session')->getFlashBag()->add('updated', 'User details updated successfully!');
                return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
            }

            return $this->render('SiteUserBundle:User:edit.html.twig', array(
                'entity'      => $entity,
                'edit_form'   => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));

        }catch(\Exception $e){
            $msg="";
            $errorMsg .= "WARNING >> Updation Error :: ";
            $msg .= get_class($e). " >> ";
            $msg .= $e->getMessage();
            $errorMsg .= $msg;
        }

        $this->get('session')->getFlashBag()->add('showindex', $errorMsg);
        return $this->redirect($this->generateUrl('user'));

    }
    /**
     * Deletes a User entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $errorMsg = $msg= "";

        try{

            $form = $this->createDeleteForm($id);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity = $em->getRepository('SiteUserBundle:User')->find($id);

                if (!$entity) {
                    throw $this->createNotFoundException('Unable to find User entity.');
                }

                $em->remove($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('showindex', 'User deleted successfully!');
            }

            return $this->redirect($this->generateUrl('user'));

        }catch(\Exception $e) {

            $errorMsg .= "WARNING >> Deletion Error :: ";
            $msg .= get_class($e). " >> ";
            $msg .= $e->getMessage();
            $errorMsg .= $msg;
        }

        $this->get('session')->getFlashBag()->add('showindex', $errorMsg);
        return $this->redirect($this->generateUrl('user'));

    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
