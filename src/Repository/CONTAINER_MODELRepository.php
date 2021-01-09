<?php

namespace App\Repository;

use App\Entity\CONTAINER_MODEL;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CONTAINER_MODEL|null find($id, $lockMode = null, $lockVersion = null)
 * @method CONTAINER_MODEL|null findOneBy(array $criteria, array $orderBy = null)
 * @method CONTAINER_MODEL[]    findAll()
 * @method CONTAINER_MODEL[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CONTAINER_MODELRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CONTAINER_MODEL::class);
    }

    // /**
    //  * @return CONTAINERMODEL[] Returns an array of CONTAINERMODEL objects
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
    public function findOneBySomeField($value): ?CONTAINERMODEL
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