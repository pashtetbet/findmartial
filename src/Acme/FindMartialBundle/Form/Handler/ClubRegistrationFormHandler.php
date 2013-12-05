<?php

namespace Acme\FindMartialBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler;
use FOS\UserBundle\Model\UserInterface;
use Acme\FindMartialBundle\Entity\Client;
use Acme\FindMartialBundle\Entity\Club;

class ClubRegistrationFormHandler extends RegistrationFormHandler
{
    /**
     * @param boolean $confirmation
     */
    public function process($confirmation = false)
    {
        $user = $this->createUser();
        $clientEntity   = new Client();
        $clubEntity     = new Club();

        //Установим клубу пользовательский признак
        $clubEntity->setSelfClient($clientEntity);
        //Добавим клуб в общий список клубов клиента
        $clubEntity->setClient($clientEntity);

        $user->setClient($clientEntity);
        $user->setClub($clubEntity);

        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {

                $this->onClubSuccess($user, $clientEntity, $clubEntity, $confirmation);

                return true;
            }

        }

        return false;
    }


    protected function onClubSuccess(UserInterface $user, Client $client, Club $club, $confirmation)
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

        $user->setName($club->getName());
        $client->setName($user->getName());

        $this->userManager->updateClubUser($user, $client, $club);
    }

}
