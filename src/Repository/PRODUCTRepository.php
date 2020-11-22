<?php

namespace App\Repository;

use App\Entity\PRODUCT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PRODUCT|null find($id, $lockMode = null, $lockVersion = null)
 * @method PRODUCT|null findOneBy(array $criteria, array $orderBy = null)
 * @method PRODUCT[]    findAll()
 * @method PRODUCT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Integer      getProductVolume($id)
 */
class PRODUCTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PRODUCT::class);
    }

    public function getProductVolume($id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT LENGTH*WIDTH*HEIGHT AS volume 
            FROM PRODUCT
            WHERE ID = ?;
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
