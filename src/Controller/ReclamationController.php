<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponse;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use App\Repository\ReponseRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    /**
     * @Route("/reclamation", name="app_reclamation")
     */
    public function index(Request $request,ReclamationRepository $repository,UserRepository $userRepository): Response
    {
            $reclamations = $repository->findAll();
            $reclamation = new Reclamation();
            $form = $this->createForm(ReclamationType::class,$reclamation);
            $form->handleRequest($request);
            $res = new Response();
            $res->setContent('hello from admin');
            if($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();

                $user = $userRepository->find(1);
                $reclamation->setUser($user);
                $em->persist($reclamation);
                $em->flush();
                return $this->redirectToRoute('app_reclamation');

            }
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController','reclamation'=>$reclamations,'form'=>$form->createView(),'res'=>$res
        ]);
    }
    /**
     * @Route("/getresponse/{id}", name="getres")
     */
    public function getResponse($id,ReponseRepository $repository): Response
    {

       $response = $repository->findOneBy(['reclamation'=>intval($id)]);

        return new JsonResponse([
            'id'=>$id,
            'content' => $this->renderView('reclamation/response.html.twig',['res'=>$response])

        ]);

    }
    /**
     * @Route("/rec/delete/{id}", name="supprimerrec")
     */
    public function delete(Reclamation $reclamation,ReponseRepository $repository): Response
    {
      $em = $this->getDoctrine()->getManager();
        $response = $repository->findOneBy(['reclamation'=>intval($reclamation->getId())]);
        if($response!=null){
            $em->remove($response);
            $em->flush();
        }
        $em->remove($reclamation);
        $em->flush();


        return $this->redirectToRoute('app_reclamation');


    }

}
