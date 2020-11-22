<?php

namespace App\Repository;

use App\Entity\CONTAINERMODEL;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CONTAINERMODEL|null find($id, $lockMode = null, $lockVersion = null)
 * @method CONTAINERMODEL|null findOneBy(array $criteria, array $orderBy = null)
 * @method CONTAINERMODEL[]    findAll()
 * @method CONTAINERMODEL[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CONTAINERMODELRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CONTAINERMODEL::class);
    }
}
