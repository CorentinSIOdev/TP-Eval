<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class DetailsAnnonceController extends AbstractController
{
    #[Route('/details/annonce-{id}', name: 'route_details_annonce')]
    public function index(ManagerRegistry $doctrine, $id): Response
    {   
        $repository = $doctrine->getManager()->getRepository(Annonce::class);
        $detailsAnnonce = $repository->find($id);

        $titre = $detailsAnnonce->getTitle();
        $desc = $detailsAnnonce->getDescription();
        $price = $detailsAnnonce->getPrice();
        $categorie = $detailsAnnonce->getCategorie();
        $user = $detailsAnnonce->getUser();
        $dateCreate = $detailsAnnonce->getCreatedAt();
        $dateUpdate = $detailsAnnonce->getUpdatedAt();

        return $this->render('details_annonce/index.html.twig', [
            'controller_name' => 'DetailsAnnonceController',
            'titre' => $titre,
            'desc' => $desc,
            'prix' => $price,
            'cat' => $categorie,
            'user' => $user,
            'date_create' => $dateCreate,
            'date_update' => $dateUpdate
        ]);
    }
}
