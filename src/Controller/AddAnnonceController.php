<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\User;
use App\Form\AddAnnonceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AddAnnonceController extends AbstractController
{
    #[Route('/ajout/annonce-user-{id}', name: 'route_add_annonce')]
    public function ajoutAnnonce(Request $request, ManagerRegistry $doctrine, $id): Response
    {   
        $entityManager = $doctrine->getManager();
        $formAddAnnonce = new Annonce();
        
        $id = $this->getUser();
        $formAddAnnonce->setUser($id);

        $form = $this->createForm(AddAnnonceFormType::class, $formAddAnnonce);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $formAddAnnonce = $form->getData();
            $entityManager->persist($formAddAnnonce);
            $entityManager->flush();

            $this->addFlash(
                "successAdd",
                "Votre annonce a été ajoutée avec succès."
            );

            return $this->redirectToRoute('route_accueil');
        }

        return $this->render('add_annonce/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
