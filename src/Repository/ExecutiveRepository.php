<?php

namespace App\Repository;

use App\Entity\Executive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Executive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Executive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Executive[]    findAll()
 * @method Executive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExecutiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Executive::class);
    }

    // /**
    //  * @return Executive[] Returns an array of Executive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Executive
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
