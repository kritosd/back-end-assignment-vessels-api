<?php

namespace App\Repository;

use App\Entity\VesselStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VesselStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method VesselStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method VesselStatus[]    findAll()
 * @method VesselStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VesselStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VesselStatus::class);
    }

    // /**
    //  * @return VesselStatus[] Returns an array of VesselStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VesselStatus
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
