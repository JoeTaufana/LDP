<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EvenementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/agenda', name: 'agenda')]
    public function agenda(
        EvenementRepository $evenementRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
            $data = $evenementRepository ->findAllOrderByDate();

            $evenements = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            3
            );
            
        return $this->render('evenement/agenda.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/agenda/{slug}', name: 'evenementsDetails')]
    public function details(
        string $slug,
        EvenementRepository $evenementRepository
    ): Response {
        $evenement = $evenementRepository->findOneBySlug($slug);

        if (!$evenement) {
            throw $this->createNotFoundException('Événement non trouvé');
        }

        return $this->render('evenement/details.html.twig', [
            'evenement' => $evenement,
        ]);
    }
}
