<?php

namespace App\Repository;

use App\Entity\Vessel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vessel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vessel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vessel[]    findAll()
 * @method Vessel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VesselRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vessel::class);
    }

    // /**
    //  * @return Vessel[] Returns an array of Vessel objects
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
    public function findOneBySomeField($value): ?Vessel
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
