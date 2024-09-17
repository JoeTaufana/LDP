<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationController extends AbstractController
{
    #[Route('/association', name: 'association')]
    public function Membre(
        MembreRepository $MembreRepository
    ): Response {
        $Membre = $MembreRepository ->findAll();

        return $this->render('association/index.html.twig', [
            'Membre' => $Membre,
        ]);
    }
}
