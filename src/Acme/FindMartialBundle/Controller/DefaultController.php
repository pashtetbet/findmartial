<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @Route("/master_create", name="master_create")
     * @Method("GET")
     * @Template()
     */
    public function createMasterAction()
    {
    	return $this->render('AcmeFindMartialBundle:Default:actionSuccess.html.twig');
    	//$user = $this->container->get('security.context')->getToken()->getUser();
    	//$user->addRole('ROLE_MASTER');
        //return $this->render('AcmeFindMartialBundle:Default:index.html.twig');
    }

     /**
     * @Route("/client_create", name="client_create")
     * @Method("GET")
     * @Template()
     */
    public function createClientAction()
    {
        return $this->render('AcmeFindMartialBundle:Default:actionSuccess.html.twig');
    	//$user = $this->container->get('security.context')->getToken()->getUser();
    	//$user->addRole('ROLE_CLIENT');
        //return $this->render('AcmeFindMartialBundle:Default:index.html.twig');
    }

}
