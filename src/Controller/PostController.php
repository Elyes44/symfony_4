<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="app_post")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }
    /**
     * @Route("/post/delete/{id}", name="deletepost")
     */
    public function deletepost(Post $post): Response
    {
        $em = $this->getDoctrine()->getManager();
        foreach ($post->getCommentaires() as $comment){
            $em->remove($comment);
            $em->flush();


        }
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('app_post');

    }
    /**
     * @Route("/update/post/{id}", name="updatepost")
     */
    public function updatepost(PostRepository $postRepository,Request $request,UserRepository $repository,Post $post): Response
    {

        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);
        $user = $repository->find(1);
        if($form->isSubmitted() && $form->isValid()){
            $post->setUser($user);
            $post->setDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_post');




        }
        return $this->render('post/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/ajouter/post", name="add_post")
     */
    public function addpost(PostRepository $postRepository,Request $request,UserRepository $repository): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class,$post);
        $form->handleRequest($request);
        $user = $repository->find(1);
        if($form->isSubmitted() && $form->isValid()){
            $post->setUser($user);
            $post->setDate(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('app_post');




        }
        return $this->render('post/ajouter.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
