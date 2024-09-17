<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationController extends AbstractController
{
    #[Route('/association', name: 'association')]
    public function membre(
        MembreRepository $membreRepository
    ): Response {
        $membres = $membreRepository ->findAll();

        return $this->render('association/index.html.twig', [
            'membre' => $membres,
        ]);
    }
}
