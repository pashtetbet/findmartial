<?php

namespace Acme\FindMartialBundle\Controller\Register;

use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\RedirectResponse;

use FOS\UserBundle\Controller\RegistrationController;


/**
 * @Route("/register")
 */
class FMRegistrationController extends RegistrationController
{

    /**
     * @Route("/{type}", requirements={"type" = "client|master|club"}, name="reg_master")
     * @Template("AcmeFindMartialBundle:FMRegistration:master.html.twig")
     */
    public function registerAction($type)
    {


        $form = $this->container->get('acme_find_martial.registration.'.$type.'_form');
        $formHandler = $this->container->get('acme_find_martial.registration.'.$type.'_form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
        

        $process = $formHandler->process($confirmationEnabled);

        if ($process) {
            $user = $form->getData();


            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        /*return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));*/
        
        return array(
            'form'   => $form->createView(),
        );
    }
}
