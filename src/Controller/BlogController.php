<?php


namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/list", name="listPosts")
     */
    public function listPostsAction()
    {
        $blogPosts = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->findAll();

        return($this->render('blogpost/list.html.twig', ["blogPosts" => $blogPosts]));
    }

    /**
     * Implémenté uniquement la recherche par ID car avec les 3 arguments il y avait problème
     * Mes essais pour implémenter les 2 autres routes sont commentés
     * @Route("/blog/{id}", name="showById")
     * @Route("/blog/{slug}", name="showBySlug", requirements={"slug"="[a-zA-Z0-9-_]*"})
     * @Route("/blog/{date}/{slug}", name="showByDateAndSlug", requirements={"date"="d{4}"})
     */
    public function showPostAction($id)
    {
        /*if(! is_null($id)) {
            $blogPost = $this->getDoctrine()
                ->getRepository(BlogPost::class)
                ->findOneBy(["id" => $id]);
        }elseif (! is_null($date)) {
            $blogPost = $this->getDoctrine()
                ->getRepository(BlogPost::class)
                ->findOneBy(["date" => $date,
                    "slug" => $slug]);
        }else{
            $blogPost = $this->getDoctrine()
                ->getRepository()
                ->findOneBy(["slug" => $slug]);
        }*/

       $blogPost = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->findOneBy(["id" => $id]);

        return($this->render('blogpost/show.html.twig', ["blogpost" => $blogPost]));
    }


}