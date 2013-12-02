<?php



namespace Acme\FindMartialBundle\Doctrine;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Doctrine\UserManager as BaseUserManager;
use Acme\FindMartialBundle\Entity\Client;
use Acme\FindMartialBundle\Entity\Master;
use Acme\FindMartialBundle\Entity\Club;


class UserManager extends BaseUserManager
{

    public function updateMasterUser(UserInterface $user, Client $client, Master $master, $andFlush = true)
    {

        $this->updateCanonicalFields($user);
        $this->updatePassword($user);

        $this->objectManager->persist($user);
        $this->objectManager->persist($client);
        $this->objectManager->persist($master);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    public function updateClubUser(UserInterface $user, Client $client, Club $club, $andFlush = true)
    {
        $this->updateCanonicalFields($user);
        $this->updatePassword($user);

        $this->objectManager->persist($user);
        if ($andFlush) {
            $this->objectManager->flush();
        }
    }
}
