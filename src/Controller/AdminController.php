<?php


namespace App\Controller;


use App\Entity\BlogPost;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/new-post", name="newPost")
     */
    public function createPostAction(Request $request)
    {
        $post = new BlogPost();

        $form = $this->createFormBuilder($post)
            -> add('title', TextType::class)
            -> add('slug', TextType::class)
            -> add('content', TextType::class)
            -> add('date', IntegerType::class)
            -> add('category', TextType::class)
            -> add('featured', CheckboxType::class, ['required' => false])
            -> add('create', SubmitType::class,['label' => 'Create post'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute("listPosts");
        }
        return $this->render('admin/create.html.twig', ['form' => $form->createView(),   ]);
    }

    /**
     * @Route("/admin/update-post/{id}", name="updatePost")
     */
    public function updatePostAction(Request $request, $id)
    {
        $post = $this->getDoctrine()
            ->getRepository(BlogPost::class)
            ->findOneBy(["id" => $id]);

        $form = $this->createFormBuilder($post)
            -> add('title', TextType::class)
            -> add('slug', TextType::class)
            -> add('content', TextType::class)
            -> add('date', IntegerType::class)
            -> add('category', TextType::class)
            -> add('featured', CheckboxType::class, ['required' => false])
            -> add('create', SubmitType::class,['label' => 'Update post'])
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute("listPosts");
        }
        return $this->render('admin/update.html.twig', ['form' => $form->createView(),   ]);
    }

    /**
     * @Route("/{id}", name="deletePost", methods={"DELETE"})
     */
    public function delete(Request $request, BlogPost $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('listPosts');
    }
}