<?php

namespace App\Repository;

use App\Entity\CONTAINER;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CONTAINER|null find($id, $lockMode = null, $lockVersion = null)
 * @method CONTAINER|null findOneBy(array $criteria, array $orderBy = null)
 * @method CONTAINER[]    findAll()
 * @method CONTAINER[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CONTAINERRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CONTAINER::class);
    }

    /**
     * @return Integer Returns an array of CONTAINER objects
     */
    public function checkForSpace($containerShipId){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT COUNT(*) c FROM CONTAINER WHERE CONTAINERSHIP_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $containerShipId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * @return Integer Return the volume of a container
     */
    public function getVolume($id){
        
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT MAX(cm.LENGTH*cm.WIDTH*cm.HEIGHT) as volume FROM CONTAINER c, CONTAINER_MODEL cm WHERE cm.ID = c.CONTAINER_MODEL_ID AND c.id = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
    * @return Integer Return the used volume of a container
    */
    public function getUsedVolume($id){
        $conn = $this->getEntityManager()->getConnection();

        $sql = "SELECT IFNULL(SUM(cp.QUANTITY*p.LENGTH*p.WIDTH*p.HEIGHT), 0) as used FROM CONTAINER_PRODUCT cp, PRODUCT p, CONTAINER c WHERE cp.PRODUCT_ID = p.ID AND cp.CONTAINER_ID = c.ID AND c.ID = ? ;";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}