<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public const CATEGORY = 'test';
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("categorie1");
        $manager->persist($category);
        $this->addReference(self::CATEGORY, $category);
        $manager->flush();
    }
}
