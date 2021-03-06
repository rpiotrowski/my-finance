<?php

namespace App\Repository;

use App\Entity\Inflation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inflation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inflation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inflation[]    findAll()
 * @method Inflation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InflationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inflation::class);
    }

    /**
     * @return Inflation[]
     */
    public function findYearsWithInflation(): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.CPI_Index >= 100')
            ->orderBy('i.year', 'DESC')
            ->getQuery()->getResult();
    }

    /**
     * @return Inflation[]
     */
    public function findYearsWithDeflation(): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.CPI_Index < 100')
            ->orderBy('i.year', 'DESC')
            ->getQuery()->getResult();
    }
}
