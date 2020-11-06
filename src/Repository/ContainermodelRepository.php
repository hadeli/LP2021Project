<?php

namespace App\Repository;

use App\Entity\Containermodel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Containermodel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Containermodel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Containermodel[]    findAll()
 * @method Containermodel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainermodelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Containermodel::class);
    }

    // /**
    //  * @return Containermodel[] Returns an array of Containermodel objects
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
    public function findOneBySomeField($value): ?Containermodel
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
