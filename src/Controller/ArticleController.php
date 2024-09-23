<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/actualites', name: 'actualites')]
        public function index(CategorieRepository $categorieRepository): Response
        {
            return $this->render('articles/index.html.twig', [
                'categories' => $categorieRepository ->findAll(),
            ]);
        }

    #[Route('/actualites/{slug}', name: 'actualitesCategorie')]
    public function categorie(
        string $slug, 
        CategorieRepository $categorieRepository, 
        PaginatorInterface $paginator, 
        Request $request): Response
    {
        // Recherche la catégorie avec son slug et charge aussi ses articles
        $categorie = $categorieRepository->findOneBySlugWithArticles($slug);

        if (!$categorie) {
            throw $this->createNotFoundException('Catégorie non trouvée');
        }

        // Appelle une méthode privée pour gérer la pagination des articles de la catégorie
        $articles = $this->paginateArticles($categorie->getArticle(), $paginator, $request);

        return $this->render('articles/articles.html.twig', [
            'categories' => $categorie,
            'articles' => $articles,
        ]); 
            }

    #[Route('/articles', name: 'articles')]
        public function article(
        ArticleRepository $articleRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response {
        
        // Récupère tous les articles de la base de données
        $data = $articleRepository ->findAll();

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

    #[Route('/articles/{slug}', name: 'articlesDetails')]
        public function details(
        ArticleRepository $articleRepository,
        string $slug
        ): Response {
            $article = $articleRepository->findOneBySlug($slug);

            if (!$article) {
                throw $this->createNotFoundException('Article non trouvé');
            }

            $listeArticles = $articleRepository->findAllWithoutCurrent($slug);

        return $this->render('articles/details.html.twig', [
            'articles' => $article,
            'listeArticles' => $listeArticles,
        ]);
    }


    
}
