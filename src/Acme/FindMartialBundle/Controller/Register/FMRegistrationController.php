<?php

namespace Acme\FindMartialBundle\Controller\Register;

use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\RedirectResponse;

use FOS\UserBundle\Controller\RegistrationController;
use Symfony\Component\Debug\Debug;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;


/**
 * @Route("/register")
 */
class FMRegistrationController extends RegistrationController
{

    /**
     * @Route("/{type}", requirements={"type" = "client|master|club"}, name="reg_user")
     */
    public function registerAction($type)
    {

Debug::enable();
        $form = $this->container->get('acme_find_martial.registration.'.$type.'_form');
        $formHandler = $this->container->get('acme_find_martial.registration.'.$type.'_form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');
        

        $process = $formHandler->process($confirmationEnabled);

        if ($process) {
            $user = $form->getData();


            $method = 'get'.ucfirst($type);
            if(method_exists($user, $method) && $method != 'getClient'){
                $entity = call_user_func_array(array($user, $method), array());

                // creating the ACL
                $aclProvider = $this->container->get('security.acl.provider');
                $objectIdentity = ObjectIdentity::fromDomainObject($entity);
                $acl = $aclProvider->createAcl($objectIdentity);

                // retrieving the security identity of the currently logged-in user
                $securityIdentity = UserSecurityIdentity::fromAccount($user);

                // grant owner access
                $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
                $aclProvider->updateAcl($acl);
            }


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

        return $this->container->get('templating')->renderResponse('AcmeFindMartialBundle:FMRegistration:'.$type.'.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
        
        /*return array(
            'form'   => $form->createView(),
        );*/
    }
}
