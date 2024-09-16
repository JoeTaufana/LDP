<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use App\Repository\CategoriesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route('/actualites', name: 'actualites')]
        public function index(CategoriesRepository $categoriesRepository): Response
        {
            return $this->render('articles/index.html.twig', [
                'categories' => $categoriesRepository ->findAll(),
            ]);
        }

    #[Route('/actualites/{slug}', name: 'actualitesCategorie')]
    public function categorie(string $slug, CategoriesRepository $categoriesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Recherche la catégorie avec son slug et charge aussi ses articles
        $categories = $categoriesRepository->findOneBySlugWithArticles($slug);

        if (!$categories) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Appelle une méthode privée pour gérer la pagination des articles de la catégorie
        $articles = $this->paginateArticles($categories->getArticles(), $paginator, $request);

        return $this->render('articles/articles.html.twig', [
            'categories' => $categories,
            'articles' => $articles,
        ]); 
            }

    #[Route('/articles', name: 'articles')]
        public function articles(
        ArticlesRepository $articlesRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
        
        // Récupère tous les articles de la base de données
        $data = $articlesRepository ->findAll();

        // Appelle la même méthode privée pour paginer les articles récupérés
        $articles = $this->paginateArticles($data, $paginator, $request);

        return $this->render('articles/actualites.html.twig', [
            'articles' => $articles,
        ]);
    }

    // Méthode privée pour gérer la pagination des articles
    // Cette méthode est appelée dans les deux actions (categorie et articles)
    private function paginateArticles($data, PaginatorInterface $paginator, Request $request)
    {
        return $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );
    }



    
}
