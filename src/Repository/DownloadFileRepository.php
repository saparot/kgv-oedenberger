<?php

namespace App\Repository;

use App\Entity\DownloadFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use \Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DownloadFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method DownloadFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method DownloadFile[]    findAll()
 * @method DownloadFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DownloadFileRepository extends ServiceEntityRepository {

    function __construct (ManagerRegistry $registry) {
        parent::__construct($registry, DownloadFile::class);
    }

    /**
     * @param int $id
     *
     * @return DownloadFile|null
     * @throws NonUniqueResultException
     */
    function findForDownload (int $id): ?DownloadFile {
        return $this->createQueryBuilder('d')->andWhere('d.id = :val')->setParameter('val', $id)->getQuery()->getOneOrNullResult();
    }
}
