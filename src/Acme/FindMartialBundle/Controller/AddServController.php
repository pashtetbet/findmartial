<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\FindMartialBundle\Entity\AddServ;
use Acme\FindMartialBundle\Form\AddServType;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

/**
 * AddServ controller.
 *
 * @Route("/addserv")
 */
class AddServController extends Controller
{
    /**
     * Lists all AddServ entities.
     *
     * @Route("/", name="addserv")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeFindMartialBundle:AddServ')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new AddServ entity.
     *
     * @Route("/", name="addserv_create")
     * @Method("POST")
     * @Template("AcmeFindMartialBundle:AddServ:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new AddServ();
        $form = $this->createForm(new AddServType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $securityIdentity = UserSecurityIdentity::fromAccount($user);

            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            return $this->redirect($this->generateUrl('addserv', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new AddServ entity.
     *
     * @Route("/new", name="addserv_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AddServ();
        $form   = $this->createForm(new AddServType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AddServ entity.
     *
     * @Route("/{id}/edit", name="addserv_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFindMartialBundle:AddServ')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AddServ entity.');
        }

        $securityContext = $this->get('security.context');
        
        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $entity)) {
            throw new AccessDeniedException();
        }

        $editForm = $this->createForm(new AddServType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing AddServ entity.
     *
     * @Route("/{id}", name="addserv_update")
     * @Method("PUT")
     * @Template("AcmeFindMartialBundle:AddServ:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFindMartialBundle:AddServ')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AddServ entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new AddServType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('addserv_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a AddServ entity.
     *
     * @Route("/{id}", name="addserv_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeFindMartialBundle:AddServ')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AddServ entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('addserv'));
    }

    /**
     * Creates a form to delete a AddServ entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
