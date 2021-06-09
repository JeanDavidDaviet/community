<?php

namespace App\Repository;

use App\Entity\PageGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageGroup[]    findAll()
 * @method PageGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageGroup::class);
    }

    // /**
    //  * @return PageGroup[] Returns an array of PageGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PageGroup
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
