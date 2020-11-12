<?php

namespace App\Repository;

use App\Entity\CONTAINERPRODUCT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CONTAINERPRODUCT|null find($id, $lockMode = null, $lockVersion = null)
 * @method CONTAINERPRODUCT|null findOneBy(array $criteria, array $orderBy = null)
 * @method CONTAINERPRODUCT[]    findAll()
 * @method CONTAINERPRODUCT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CONTAINERPRODUCTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CONTAINERPRODUCT::class);
    }

    public function getRemainingSpace($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT MAX(cm.LENGTH*cm.WIDTH*cm.HEIGHT)-SUM(cp.QUANTITY*p.LENGTH*p.WIDTH*p.HEIGHT) as remaining
            FROM CONTAINER_PRODUCT cp, PRODUCT p, CONTAINER c, CONTAINER_MODEL cm
            WHERE cp.PRODUCT_ID = p.ID
            AND cp.CONTAINER_ID = c.ID
            AND c.CONTAINER_MODEL_ID = cm.ID
            AND cp.CONTAINER_ID = ? ;  
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // /**
    //  * @return CONTAINERPRODUCT[] Returns an array of CONTAINERPRODUCT objects
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
    public function findOneBySomeField($value): ?CONTAINERPRODUCT
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
