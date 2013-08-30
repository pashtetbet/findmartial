<?php
// src/Acme/FindMartialBundle/DataFixtures/ORM/LoadCityData.php

namespace Acme\FindMartialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\FindMartialBundle\Entity\City;

class LoadCityData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $cities = array(
            'Москва',
            'Ростов',
            'Пермь',
        );


        foreach ($cities as $city) {
            $cityObj = new City();
            $cityObj->setName($city);
            $manager->persist($cityObj);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}