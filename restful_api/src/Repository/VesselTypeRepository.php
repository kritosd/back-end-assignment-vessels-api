<?php

namespace App\Repository;

use App\Entity\VesselType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VesselType|null find($id, $lockMode = null, $lockVersion = null)
 * @method VesselType|null findOneBy(array $criteria, array $orderBy = null)
 * @method VesselType[]    findAll()
 * @method VesselType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VesselTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VesselType::class);
    }

    // /**
    //  * @return VesselType[] Returns an array of VesselType objects
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
    public function findOneBySomeField($value): ?VesselType
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
