<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\FindMartialBundle\Entity\Client;
use Symfony\Component\HttpFoundation\Request;


class ClientController extends Controller
{
    public function createAction(Request $request)
    {
    
			$user = $this->container->get('security.context')->getToken()->getUser();
			if($user->getClient() !== null)
				return $this->render('AcmeFindMartialBundle:Client:show.html.twig', array(
					'client' => $user->getClient(),
				));	
			
    	//TODO разобраться почему я не могу сохранить ссылку на клиента простым методом setUser. Зачем тогда этот метод нужен?
			$client = new Client();
			//$client->setUser($this->container->get('security.context')->getToken()->getUser());
			$user->setClient($client);
			
			
			$form = $this->createFormBuilder($client)
				->add('name', 'text')
				->add('isIndividual', 'checkbox', array('required' => false))
				->getForm()
				
			;

			if ($request->getMethod() == 'POST') {
				$form->bind($request);
				if ($form->isValid()) {
					$em = $this->getDoctrine()->getManager();
					$em->persist($client);
					$em->persist($user);
					$em->flush();
					return $this->redirect($this->generateUrl('client_success'));
		  	}
		  }
		  
			return $this->render('AcmeFindMartialBundle:Client:create.html.twig', array(
				'form' => $form->createView(),
			));
    }
    
    public function successAction(Request $request)
    {
			return $this->render('AcmeFindMartialBundle:Client:success.html.twig');
    }    
}
