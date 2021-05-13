<?php

namespace App\Repository;

use App\Entity\DownloadFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DownloadFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method DownloadFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method DownloadFile[]    findAll()
 * @method DownloadFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DownloadFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DownloadFile::class);
    }

    // /**
    //  * @return DownloadFile[] Returns an array of DownloadFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DownloadFile
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
