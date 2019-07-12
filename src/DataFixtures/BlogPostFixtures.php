<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class BlogPostFixtures
 * @package App\DataFixtures
 * creates fake data
 */
class BlogPostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 20 ; $i++){
            $blogPost = new BlogPost();
            $blogPost->setTitle('title' . $i);
            $blogPost->setSlug('slug' . $i);
            $blogPost->setContent('Le contenu est contenu dans le contenant.');
            $blogPost->setDate('200' . $i);
            $blogPost->setCategory('category' . $i);
            $blogPost->setFeatured($i%2 === 0 ? true : false);
            $manager->persist($blogPost);
        }
        $manager->flush();
    }
}
