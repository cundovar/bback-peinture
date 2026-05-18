<?php

namespace App\Repository;

use App\Entity\Oeuvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oeuvre>
 */
class OeuvreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oeuvre::class);
    }

    /**
     * @return Oeuvre[]
     */
    public function findPopular(int $limit = 6): array
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.likes', 'l')
            ->addSelect('COUNT(l.id) AS HIDDEN likes_count')
            ->groupBy('o.id')
            ->orderBy('likes_count', 'DESC')
            ->addOrderBy('o.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
