<?php

namespace Acme\FindMartialBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\FindMartialBundle\Entity\Client;
use Symfony\Component\HttpFoundation\Request;


class ClientController extends Controller
{
	public function createAction(Request $request)
	{
		//должно быть разделение по актионам создать редактировать удалить показать (CRUD)
		// ссылка "стать клиентом" проверяет существующие роли и, если можно, назначает роль клиента. Затем редиректит на форму создания клиента
		// ссылка "стать мастером" проверяет существующие роли и, если можно назначает роль мастера. Затем редиректит на форму создания клиента и мастера

		$user = $this->container->get('security.context')->getToken()->getUser();
		if($user->getClient() !== null)
			return $this->render('AcmeFindMartialBundle:Client:show.html.twig', array(
				'client' => $user->getClient(),
			));	

		$client = new Client();
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
