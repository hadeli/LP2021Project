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
}
