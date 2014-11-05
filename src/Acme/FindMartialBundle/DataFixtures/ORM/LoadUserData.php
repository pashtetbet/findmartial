<?php
// src/Acme/FindMartialBundle/DataFixtures/ORM/LoadUserData.php

namespace Acme\FindMartialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Acme\FindMartialBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userAdmin)
        ;
        $userAdmin->setPassword($encoder->encodePassword('admin', $userAdmin->getSalt()));


        $userAdmin->setEmail('admin@test.ru');
        $userAdmin->setRoles(array('ROLE_ADMIN'));
        $userAdmin->setName('admin');
        $userAdmin->setFamily('admin');

        $userAdmin->setEnabled(true);

        $manager->persist($userAdmin);
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}