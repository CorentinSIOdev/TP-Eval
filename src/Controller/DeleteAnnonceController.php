<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class DeleteAnnonceController extends AbstractController
{
    #[Route('/delete/annonce-{id}', name: 'route_delete_annonce')]
    public function index(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $deleteAnnonce = $entityManager->getRepository(Annonce::class)->find($id);

        if(!$deleteAnnonce) {
            throw $this->createNotFoundException(
                "Aucune annonce n'a été trouvée sous l'id : $id"
            );
        }

        $entityManager->remove($deleteAnnonce);
        $entityManager->flush();

        $this->addFlash(
            "successDelete",
            "Votre annonce a été supprimée avec succès."
        );

        return $this->redirectToRoute(
            'route_accueil'
        );
    }
}
