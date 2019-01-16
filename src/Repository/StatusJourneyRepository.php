<?php

namespace App\Repository;

use App\Entity\StatusJourney;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StatusJourney|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusJourney|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusJourney[]    findAll()
 * @method StatusJourney[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusJourneyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StatusJourney::class);
    }

    // /**
    //  * @return StatusJourney[] Returns an array of StatusJourney objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatusJourney
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
