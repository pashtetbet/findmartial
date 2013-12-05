<?php

namespace Acme\FindMartialBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler;
use FOS\UserBundle\Model\UserInterface;
use Acme\FindMartialBundle\Entity\Client;
use Acme\FindMartialBundle\Entity\Master;
use Acme\FindMartialBundle\Entity\MasterClient;

class MasterRegistrationFormHandler extends RegistrationFormHandler
{
    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false)
    {
        $user = $this->createUser();
        $clientEntity           = new Client();
        $masterEntity           = new Master();
        $masterClientEntity     = new MasterClient($masterEntity, $clientEntity);

        //Установим мастеру пользовательский признак
        $masterEntity->setSelfClient($clientEntity);
        $user->setClient($clientEntity);
        $user->setMaster($masterEntity);

        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {

            $this->form->submit($this->request);

            if ($this->form->isValid()) {

                $this->onMasterSuccess($user, $clientEntity, $masterEntity, $masterClientEntity, $confirmation);

                return true;
            }

        }

        return false;
    }


    protected function onMasterSuccess(UserInterface $user, Client $client, Master $master, MasterClient $masterClient, $confirmation)
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

        $user->setName($master->getName());
        $user->setFamily($master->getFamily());
        $client->setName($master->getName().' '.$master->getFamily().' '.$master->getPatronym());

        $this->userManager->updateMasterUser($user, $client, $master, $masterClient);
    }
}
