<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/actualites', name: 'actualites')]
    public function actualites(
        ArticlesRepository $articlesRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
        $data = $articlesRepository ->findAll();

        $articles = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('articles/actualites.html.twig', [
            'articles' => $articles,
        ]);
    }
}
