<?php
// src/Acme/FindMartialBundle/DataFixtures/ORM/LoadArtData.php

namespace Acme\FindMartialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\FindMartialBundle\Entity\Art;

class LoadArtData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $arts = array(
            'Айкидо'                    => 'classic',
            'Бокс'                      => 'classic',
            'Вольная борьба'            => 'classic',
            'Греко-римская борьба'      => 'classic',
            'Джиу-джитсу'               => 'classic',
            'Дзюдо'                     => 'classic',
            'Каратэ Киокушинкай'        => 'classic',
            'Грэпплинг'                 => 'classic',
            'Кикбоксинг'                => 'classic',
            'Кудо'                      => 'classic',
            'Боевое самбо'              => 'classic',
            'Рукопашный бой'            => 'classic',
            'Самбо'                     => 'classic',
            'Тайский бокс'              => 'classic',
            'Тхэквондо'                 => 'classic',
            'Сават'                     => 'classic',
            'Смешанный стиль (MMA)'     => 'classic',
            'Ножевой бой'               => 'classic',
            'Сумо'                      => 'pervert',
            'Капоэйра'                  => 'pervert',
            'Кендо'                     => 'pervert',
            'Тайцзи цюань'              => 'pervert',
            'Фехтование'                => 'pervert',
            'Ушу'                       => 'pervert',
            'Вин-чун'                   => 'pervert',
            'Функциональная подготовка' => 'support',
            'Массаж'                    => 'support',
            'Медицинские услуги'        => 'support',
        );


        foreach ($arts as $art => $type) {
            $artObj = new Art();
            $artObj->setName($art);
            $artObj->setType($type);
            $manager->persist($artObj);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}