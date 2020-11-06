<?php

namespace App\Repository;

use App\Entity\Containerproduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Containerproduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Containerproduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Containerproduct[]    findAll()
 * @method Containerproduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainerproductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Containerproduct::class);
    }

    // /**
    //  * @return Containerproduct[] Returns an array of Containerproduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Containerproduct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
