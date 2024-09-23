<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ArticleRepository $articleRepository, EvenementRepository $evenementRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'article' => $articleRepository ->troisDerniers(),
            'evenement' => $evenementRepository ->derniers(),
        ]);
    }
}
