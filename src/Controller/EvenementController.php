<?php

namespace App\Controller;

use App\Repository\EvenementsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/agenda', name: 'agenda')]
    public function agenda(
        EvenementsRepository $evenementsRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
            $data = $evenementsRepository ->findAll();

            $evenements = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            3
            );
            
        return $this->render('evenement/agenda.html.twig', [
            'evenements' => $evenements,
        ]);
    }
}
