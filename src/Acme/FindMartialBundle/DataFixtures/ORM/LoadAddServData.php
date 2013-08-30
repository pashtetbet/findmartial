<?php
// src/Acme/FindMartialBundle/DataFixtures/ORM/LoadAddServData.php

namespace Acme\FindMartialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\FindMartialBundle\Entity\AddServ;

class LoadAddServData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $servs = array(
            'баня',
            'сауна',
            'заточка коньков',
        );


        foreach ($servs as $serv) {
            $servObj = new AddServ();
            $servObj->setName($serv);
            $manager->persist($servObj);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}