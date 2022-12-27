<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AddAnnonceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AddAnnonceController extends AbstractController
{
    #[Route('/ajout/annonce', name: 'route_add_annonce')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {   
        $entityManager = $doctrine->getManager();
        $formAddAnnonce = new Annonce();

        $form = $this->createForm(AddAnnonceFormType::class, $formAddAnnonce);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $formAddAnnonce = $form->getData();
            $entityManager->persist($formAddAnnonce);
            $entityManager->flush();

            $this->addFlash(
                "successAdd",
                "Annonce ajouté avec succès."
            );

            return $this->redirectToRoute('route_accueil');
        }

        return $this->render('add_annonce/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
