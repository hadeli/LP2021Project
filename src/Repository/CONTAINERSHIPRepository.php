<?php

namespace App\Repository;

use App\Entity\CONTAINERSHIP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CONTAINERSHIP|null find($id, $lockMode = null, $lockVersion = null)
 * @method CONTAINERSHIP|null findOneBy(array $criteria, array $orderBy = null)
 * @method CONTAINERSHIP[]    findAll()
 * @method CONTAINERSHIP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CONTAINERSHIPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CONTAINERSHIP::class);
    }

    // /**
    //  * @return CONTAINERSHIP[] Returns an array of CONTAINERSHIP objects
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
    public function findOneBySomeField($value): ?CONTAINERSHIP
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
