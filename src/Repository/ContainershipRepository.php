<?php

namespace App\Repository;

use App\Entity\Container;
use App\Entity\Containership;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Containership|null find($id, $lockMode = null, $lockVersion = null)
 * @method Containership|null findOneBy(array $criteria, array $orderBy = null)
 * @method Containership[]    findAll()
 * @method Containership[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainershipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Containership::class);
    }


    public function isFull($containership_id)
    {
        $containership = $this->find($containership_id);
        $limit = $containership->getContainerLimit();


        // dd($yeet);

        // SELECT COUNT(CONTAINER.ID) FROM CONTAINER WHERE CONTAINERSHIP_ID=$containership_id
    }

    /*
    public function findOneBySomeField($value): ?Containership
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
