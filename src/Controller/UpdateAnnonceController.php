<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\UpdateAnnonceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class UpdateAnnonceController extends AbstractController
{
    #[Route('/update/annonce-{id}', name: 'route_update_annonce')]
    public function index(Request $request, ManagerRegistry $doctrine, $id): Response
    {

        $entityManager = $doctrine->getManager();
        $updateAnnonce = $entityManager->getRepository(Annonce::class)->find($id);

        $form = $this->createForm(UpdateAnnonceFormType::class, $updateAnnonce);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $updateAnnonce = $form->getData();
            $entityManager->flush();

            $this->addFlash(
                "successUpdate",
                "Votre annonce a été modifiée avec succès."
            );

            return $this->redirectToRoute(
                "route_accueil",
            );
        }

        $repository = $doctrine->getManager()->getRepository(Annonce::class);
        $detailsAnnonceUpdate = $repository->find($id);

        $title = $detailsAnnonceUpdate->getTitle();

        return $this->render('update_annonce/index.html.twig', [
            'controller_name' => 'UpdateAnnonceController',
            'formUpdate' => $form->createView(),
            'titre' => $title
        ]);
    }
}
