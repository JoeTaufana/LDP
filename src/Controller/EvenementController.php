<?php

namespace App\Controller;



use App\Repository\EvenementRepository;
use App\Entity\Evenement;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


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
            10
            );
            
        return $this->render('evenement/agenda.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/agenda/{slug}', name: 'evenementsDetails')]
    public function details(
        string $slug,
        EvenementRepository $evenementRepository,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        $evenement = $evenementRepository->findOneBySlug($slug);

        if (!$evenement) {
            throw $this->createNotFoundException('Événement non trouvé');
        }

        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Gérer l'inscription si le formulaire est soumis (méthode POST)
        if ($request->isMethod('POST')) {
            if ($user) {
                if ($evenement->getParticipants()->contains($user)) {
                    // Si l'utilisateur est déjà inscrit, le retirer (désinscription)
                    $evenement->removeParticipant($user);
                } else {
                    // Sinon, ajouter l'utilisateur à l'événement (inscription)
                    $evenement->addParticipant($user);
                }

                // Persister les modifications
                $entityManager->persist($evenement);
                $entityManager->flush();

                // Rediriger vers la même page pour éviter les soumissions répétées
                return $this->redirectToRoute('evenementsDetails', ['slug' => $slug]);
            } else {
                // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
                return $this->redirectToRoute('login');
            }
        }

        // Afficher les détails de l'événement
        return $this->render('evenement/details.html.twig', [
            'evenement' => $evenement,
            'user' => $user,
        ]);
    }

}
