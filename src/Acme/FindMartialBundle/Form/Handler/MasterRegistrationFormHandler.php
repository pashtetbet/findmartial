<?php

namespace Acme\FindMartialBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler;
use FOS\UserBundle\Model\UserInterface;
use Acme\FindMartialBundle\Entity\Client;
use Acme\FindMartialBundle\Entity\Master;

class MasterRegistrationFormHandler extends RegistrationFormHandler
{
    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false)
    {
        $user = $this->createUser();
        $clientEntity = new Client();
        $masterEntity = new Master();

        $user->setClient($clientEntity);
        $user->setMaster($masterEntity);

        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {

            $this->form->submit($this->request);

            if ($this->form->isValid()) {

                $this->onMasterSuccess($user, $clientEntity, $masterEntity, $confirmation);

                return true;
            }

        }

        return false;
    }


    protected function onMasterSuccess(UserInterface $user, Client $client, Master $master, $confirmation)
    {
        if ($confirmation) {
            $user->setEnabled(false);
            if (null === $user->getConfirmationToken()) {
                $user->setConfirmationToken($this->tokenGenerator->generateToken());
            }

            $this->mailer->sendConfirmationEmailMessage($user);
        } else {
            $user->setEnabled(true);
        }

        $client->setName($user->getName());

        $this->userManager->updateMasterUser($user, $client, $master);
    }
}
