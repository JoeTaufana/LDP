<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }


    /**
     * @return Article[]
     */
    public function troisDerniers()
    {
        return $this->createQueryBuilder('a')
            
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Article|null
     */
    public function findOneBySlug(string $slug): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $excludedSlug
     * @return Article[]
     */
     public function findAllWithoutCurrent(string $excludedSlug)
    {
        return $this->createQueryBuilder('a')
        ->where('a.slug != :excludedSlug')
        ->setParameter('excludedSlug', $excludedSlug)
        ->orderBy('a.id', 'DESC')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult();
    }
}
