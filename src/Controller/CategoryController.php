<?php


namespace App\Controller;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{category}", name="listCategory"
     */
    public function listByCategoryAction($category)
    {
        $posts = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy(["category" => $category]);

        return$this->render("category/list.html.twig", ["posts" => $posts]);
    }
}