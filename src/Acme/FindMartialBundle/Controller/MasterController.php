<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\FindMartialBundle\Entity\Master;
use Acme\FindMartialBundle\Entity\MasterArt;
use Acme\FindMartialBundle\Form\MasterType;
use Acme\FindMartialBundle\Form\MasterArtType;
use Acme\FindMartialBundle\Form\MasterExpsBlockType;
use Acme\FindMartialBundle\Form\MasterPhotosBlockType;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

use Xi\Bundle\AjaxBundle\Controller\JsonResponseController;

use Symfony\Component\Debug\Debug;

/**
 * Master controller.
 *
 * @Route("/master")
 */
class MasterController extends JsonResponseController
{
    /**
     * Lists all Master entities.
     *
     * @Route("/", name="master")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeFindMartialBundle:Master')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists my Masters entities.
     *
     * @Route("/my", name="my_masters")
     * @Method("GET")
     * @Template("AcmeFindMartialBundle:Master:my.html.twig")
     */
    public function myMastersAction()
    {

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->createQueryBuilder();
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();

        // Кастомный aclProvider с фильтрацией объектов по владельцу
        $aclProvider = $this->get('security.acl.provider');

        $identifier = 'Acme\FindMartialBundle\Entity\User-'.$user->getUsername();

        $ids = $aclProvider->getAllowedEntitiesIds('Acme\FindMartialBundle\Entity\Master', array($identifier), MaskBuilder::MASK_OWNER, true);

        $queryBuilder->select(array('m'))
           ->from('Acme\FindMartialBundle\Entity\Master', 'm')
        ;
        if (is_string($ids)) {
           $queryBuilder->andWhere("m.id IN ($ids)");
        }
        elseif ($ids===false) {
           $queryBuilder->andWhere("m.id = 0");
        }
        elseif ($ids===true) {
           // Global-class permission: allow all
        }

        $entities = $queryBuilder->getQuery()->getResult();

        //$entities = $em->getRepository('AcmeFindMartialBundle:Master')->findAllByUser($userId);

        return array(
            'entities' => $entities,
        );
    }

    public function saveAction(Request $request)
    {
        return $this->createJsonSuccessResponse('your response text');
    }
    public function saveArtsAction(Request $request)
    {
        return $this->createJsonSuccessResponse('your response text');
    }

    public function saveExpsAction(Request $request)
    {
        return $this->createJsonSuccessResponse('your response text');
    }

    public function savePhotosAction(Request $request)
    {
        return $this->createJsonSuccessResponse('your response text');
    }
    /**
     * Creates a new Master entity.
     *
     * @Route("/", name="master_create")
     * @Method("POST")
     * @Template("AcmeFindMartialBundle:Master:new.html.twig")
     */
    public function createAction(Request $request)
    {


        $entity  = new Master();
        $masterArtEntity = new MasterArt();

        $form           = $this->createForm(new MasterType(), $entity);


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

            $response = array('master' => $entity->getId());
            return $this->createJsonSuccessWithContent(
                    json_encode($response),
                    'enableArtsForm'
                );
            //return $this->redirect($this->generateUrl('master_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'          => $form->createView(),
            'formArt'      => $formArt->createView(),
            'formExps'      => $formExps->createView(),
            'formPhotos'    => $formPhotos->createView(),
        );


    }

    /**
     * Displays a form to create a new Master entity.
     *
     * @Route("/new", name="master_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        Debug::enable();

        $entity  = new Master();
        $masterArtEntity = new MasterArt();

        $form           = $this->createForm(new MasterType(), $entity);
        $formArt        = $this->createForm(new MasterArtType(), $masterArtEntity);
        $formExps       = $this->createForm(new MasterExpsBlockType(), $entity);
        $formPhotos     = $this->createForm(new MasterPhotosBlockType(), $entity);

        $formDelArt = $this->get('form.factory')->createNamedBuilder('form_del_art', 'form',  null, array())
            ->getForm()
        ;

        return array(
            'entity'        => $entity,
            'form'          => $form->createView(),
            'formArt'       => $formArt->createView(),
            'formExps'      => $formExps->createView(),
            'formPhotos'    => $formPhotos->createView(),
            'formDelArt'    => $formDelArt->createView(),
        );
    }

    /**
     * Finds and displays a Master entity.
     *
     * @Route("/{id}", name="master_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFindMartialBundle:Master')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Master entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Master entity.
     *
     * @Route("/{id}/edit", name="master_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFindMartialBundle:Master')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Master entity.');
        }

        $securityContext = $this->get('security.context');
        
        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $entity)) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(new MasterType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Displays a form to edit an existing Master entity.
     *
     * @Route("/spec/profile", name="master_profile_edit")
     * @Method("GET")
     * @Template()
     */
    /*public function profileAction()
    {
        $securityContext = $this->get('security.context');

        $token = $securityContext->getToken();
        $user = $token->getUser();

        $em = $this->getDoctrine()->getManager();

        $clientId = $user->getClient();


        if(isset($clientId))


        var_dump($masterId);
        die;

        $entity = $em->getRepository('AcmeFindMartialBundle:Master')->find($user->getMaster());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Master entity.');
        }

        
        // check for edit access
        if (false === $securityContext->isGranted('EDIT', $entity)) {
            throw new AccessDeniedException();
        }

        $form           = $this->createForm(new MasterType(), $entity);
        $formArt        = $this->createForm(new MasterArtType(), $masterArtEntity);
        $formExps       = $this->createForm(new MasterExpsBlockType(), $entity);
        $formPhotos     = $this->createForm(new MasterPhotosBlockType(), $entity);
        $formDelArt = $this->get('form.factory')->createNamedBuilder('form_del_art', 'form',  null, array())
            ->getForm()
        ;

        //$deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'        => $entity,
            'form'          => $form->createView(),
            'formArt'       => $formArt->createView(),
            'formExps'      => $formExps->createView(),
            'formPhotos'    => $formPhotos->createView(),
            'formDelArt'    => $formDelArt->createView(),
        );

    }*/




    /**
     * Edits an existing Master entity.
     *
     * @Route("/{id}", name="master_update")
     * @Method("PUT")
     * @Template("AcmeFindMartialBundle:Master:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeFindMartialBundle:Master')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Master entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $form = $this->createForm(new MasterType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('master_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Master entity.
     *
     * @Route("/{id}", name="master_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {

        $securityContext = $this->get('security.context');
        
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeFindMartialBundle:Master')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Master entity.');
            }

            if (false === $securityContext->isGranted('DELETE', $entity)) {
                throw new AccessDeniedException();
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('master'));
    }

    /**
     * Creates a form to delete a Master entity by id.
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
