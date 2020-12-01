<?php
namespace App\DataFixtures\ORM;
namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\PersistentObject;
use Nelmio\Alice\Loader\NativeLoader;

class LoadFixtures extends Fixture
{
    public function load(PersistentObject $object)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__ . '/fixtures.yaml')->getObjects();
        foreach($objectSet as $object)
        {
            $manager->persist($object);
        }

        $manager->flush();
    }
}