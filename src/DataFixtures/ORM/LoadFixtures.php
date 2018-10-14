<?php
declare(strict_types=1);

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

/**
 * Class LoadFixtures
 *
 * @package App\DataFixtures\ORM
 */
class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(getcwd() . '/fixtures/categories.yml')->getObjects();

        foreach($objectSet as $object)
        {
            $manager->persist($object);
        }

        $manager->flush();
    }
}
