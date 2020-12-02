<?php

namespace App\DataFixtures\ORM;


use App\Entity\Member;
use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        return array(
            __DIR__ . '/fixtures.yml',
        );
    }


    /*public function load(ObjectManager $manager)
    {

        $loader = new NativeLoader();
        //$loader = new Nelmio\Alice\Loader\NativeLoader();
        $objects = $loader->loadFile(__DIR__ . '/fixtures.yml');
        foreach ($objects as $object) {
            $manager->persist($object);
        }

        $manager->flush();
    }*/
}