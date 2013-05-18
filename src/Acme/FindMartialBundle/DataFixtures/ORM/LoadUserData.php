<?php
// src/Acme/FindMartialBundle/DataFixtures/ORM/LoadUserData.php

namespace Acme\FindMartialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\FindMartialBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setPassword('admin');
        $userAdmin->setEmail('admin@test.ru');
        $userAdmin->setRoles(array('ROLE_ADMIN'));
        $userAdmin->setName('admin');
        $userAdmin->setFamily('admin');
        $manager->persist($userAdmin);
        $manager->flush();
    }
}