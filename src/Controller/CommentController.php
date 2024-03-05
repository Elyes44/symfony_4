<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Commentaire;
use App\Entity\Post;
use App\Form\CommentType;
use App\Repository\CommentaireRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{

    /**
     * @Route("/deletecomment/{id}", name="deletecomment")
     */
    public function deletecomment($id,CommentaireRepository $repository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($repository->find(intval($id)));
        $em->flush();
        return $this->json(['success'=>'deleted']);
    }
    /**
     * @Route("/updatecomment/", name="updatecomment")
     */
    public function updatecomment(CommentaireRepository $repository): Response
    {
        $comment = $repository->find(intval($_GET['id'])) ;
        $comment->setContent($_GET['content']);
        $em=$this->getDoctrine()->getManager();
        $em->flush();


        return $this->json(['success'=>$_GET['id']]);
    }



    /**
     * @Route("/details/post/{id}", name="detailspost")
     */
    public function index(Post $post,Request $request,UserRepository $repository): Response
    {
        $comment = new Commentaire();
        $form = $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $comment->setPost($post);
            $user = $repository->find(1);
            $comment->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();



        }
        return $this->render('post/details.html.twig',['post'=>$post,'form'=>$form->createView()]);
    }
}
