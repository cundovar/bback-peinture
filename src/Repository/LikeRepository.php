<?php

namespace App\Repository;

use App\Entity\Like;
use App\Entity\Oeuvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Like>
 */
class LikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Like::class);
    }

    public function countForOeuvre(Oeuvre $oeuvre): int
    {
        return (int) $this->createQueryBuilder('l')
            ->select('COUNT(l.id)')
            ->andWhere('l.oeuvre = :oeuvre')
            ->setParameter('oeuvre', $oeuvre)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
