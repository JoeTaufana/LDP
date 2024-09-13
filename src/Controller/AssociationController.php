<?php

namespace App\Controller;

use App\Repository\MembresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationController extends AbstractController
{
    #[Route('/association', name: 'association')]
    public function membres(
        MembresRepository $membresRepository
    ): Response {
        $membres = $membresRepository ->findAll();

        return $this->render('association/index.html.twig', [
            'membres' => $membres,
        ]);
    }
}
