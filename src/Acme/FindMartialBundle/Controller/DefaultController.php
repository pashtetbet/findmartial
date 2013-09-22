<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\FindMartialBundle\Entity\Master;
use Acme\FindMartialBundle\Entity\Client;
use Acme\FindMartialBundle\Form\MasterType;
use Acme\FindMartialBundle\Form\ClientType;

class DefaultController extends Controller
{
 
     /**
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('AcmeFindMartialBundle:Default:index.html.twig');
    }
 
     /**
     * @Route("/regmaster_create", name="reg_master_create")
     * @Method("POST")
     * @Template("AcmeFindMartialBundle:Master:new.html.twig")
     */
    public function createMasterAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if($user->getClient() !== null && ($entityMaster=$user->getClient()->getMaster()) !== null)
            return $this->redirect($this->generateUrl('master_show', array('id' => $entityMaster->getId())));

        $entityMaster = new Master();
        $form = $this->createForm(new MasterType(), $entityMaster);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entityMaster);
            $entityClient  = new Client();
            $entityClient->setMaster($entityMaster);
            $entityClient->setName($entityMaster->getName());
            $em->persist($entityClient);
            $user = $this->container->get('security.context')->getToken()->getUser();
            $user->setClient($entityClient);
            $user->setRoles(array('ROLE_MASTER'));
            $em->flush();
            
            /**
            * чтобы новая роль учитывалась
            */
            $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken(
                        $user,
                        null,
                        'main',
                        $user->getRoles()
            );
            $this->container->get('security.context')->setToken($token);
            $this->get('fos_user.user_manager')->refreshUser($user);

            $translated = $this->get('translator')->trans('text.regmaster', array(), 'FindMartialBundle');
            $this->get('session')->getFlashBag()->add('notice', $translated);

            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entityMaster);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $securityIdentity = UserSecurityIdentity::fromAccount($user);

            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            return $this->redirect($this->generateUrl('master_show', array('id' => $entityMaster->getId())));
        }

        return array(
            'entity' => $entityMaster,
            'form'   => $form->createView(),
        );

    	//return $this->render('AcmeFindMartialBundle:Default:actionSuccess.html.twig');
    	//$user = $this->container->get('security.context')->getToken()->getUser();
    	//$user->addRole('ROLE_MASTER');
        //return $this->render('AcmeFindMartialBundle:Default:index.html.twig');
    }

    /**
     * Displays a form to create a new Master entity.
     *
     * @Route("/regmaster", name="reg_master")
     * @Method("GET")
     * @Template("AcmeFindMartialBundle:Master:new.html.twig")
     */
    public function newMasterAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if($user->getClient() !== null && ($entityMaster=$user->getClient()->getMaster()) !== null)
            return $this->redirect($this->generateUrl('master_show', array('id' => $entityMaster->getId())));

        $entityMaster = new Master();
        $form   = $this->createForm(new MasterType(), $entityMaster);

        return array(
            'entity' => $entityMaster,
            'form'   => $form->createView(),
        );
    }

     /**
     * @Route("/regclient_create", name="reg_client_create")
     * @Method("POST")
     * @Template("AcmeFindMartialBundle:Default:regClient.html.twig")
     */
    public function createClientAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if($user->getClient() !== null)
            return $this->redirect($this->generateUrl('client_show', array('id' => $user->getClient()->getId())));

        $entityClient  = new Client();
        $form = $this->createForm(new ClientType(), $entityClient);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entityClient);
            $user->setClient($entityClient);
            $user->setRoles(array('ROLE_CLIENT'));
            $em->flush();

            /**
            * чтобы новая роль учитывалась
            */
            $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken(
                        $user,
                        null,
                        'main',
                        $user->getRoles()
            );
            $this->container->get('security.context')->setToken($token);
            $this->get('fos_user.user_manager')->refreshUser($user);

            $translated = $this->get('translator')->trans('text.regclient', array(), 'FindMartialBundle');
            $this->get('session')->getFlashBag()->add('notice', $translated);

            return $this->redirect($this->generateUrl('client_show', array('id' => $entityClient->getId())));
        }

        return array(
            'entity' => $entityClient,
            'form'   => $form->createView(),
        );

        //return $this->render('AcmeFindMartialBundle:Default:actionSuccess.html.twig');
    	//$user = $this->container->get('security.context')->getToken()->getUser();
    	//$user->addRole('ROLE_CLIENT');
        //return $this->render('AcmeFindMartialBundle:Default:index.html.twig');
    }

    /**
     * Displays a form to create a new Master entity.
     *
     * @Route("/regclient", name="reg_client")
     * @Method("GET")
     * @Template("AcmeFindMartialBundle:Default:regClient.html.twig")
     */
    public function newClientAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if($user->getClient() !== null)
            return $this->redirect($this->generateUrl('client_show', array('id' => $user->getClient()->getId())));

        $entityClient  = new Client();
        $form   = $this->createForm(new ClientType(), $entityClient);

        return array(
            'entity' => $entityClient,
            'form'   => $form->createView(),
        );
    }

}
