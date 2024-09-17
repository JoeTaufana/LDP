<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evenement>
 *
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    /**
     * @return Evenement
     */
    public function findOneById(int $id): ?Evenement
    {
        return $this->find($id);
    }

    /**
     * @return Evenement[]
     */
    public function derniers()
    {
        return $this->createQueryBuilder('a')
            
            ->orderBy('a.rdv', 'ASC')
            ->setMaxResults(2)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Evenement[]
     */
    public function findAllOrderByDate()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.rdv', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Evenement|null
     */
    public function findOneBySlug(string $slug): ?Evenement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
