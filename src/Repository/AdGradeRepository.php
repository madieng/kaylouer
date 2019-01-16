<?php

namespace App\Repository;

use App\Entity\AdGrade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AdGrade|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdGrade|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdGrade[]    findAll()
 * @method AdGrade[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdGradeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdGrade::class);
    }

    // /**
    //  * @return AdGrade[] Returns an array of AdGrade objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdGrade
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
