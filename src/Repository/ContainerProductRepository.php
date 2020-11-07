<?php

namespace App\Repository;

use App\Entity\ContainerProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContainerProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContainerProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContainerProduct[]    findAll()
 * @method ContainerProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContainerProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContainerProduct::class);
    }



  /*  public function getAllProductInside($id){
        $qb = $this->createQueryBuilder('cp')
            ->select('cp')
            ->where('cp.container = :id')
            ->setParameter('id', $id);

        $result = $qb->getQuery()->execute(array(), AbstractQuery::HYDRATE_ARRAY);
        return $result;

    }
  */

    // /**
    //  * @return ContainerProduct[] Returns an array of ContainerProduct objects
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
    public function findOneBySomeField($value): ?ContainerProduct
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
