<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\EvenementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticlesRepository $articlesRepository, EvenementsRepository $evenementsRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articlesRepository ->troisDerniers(),
            'evenements' => $evenementsRepository ->derniers(),
        ]);
    }
}
