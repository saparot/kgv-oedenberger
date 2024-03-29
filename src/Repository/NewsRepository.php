<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository {

    public function __construct (ManagerRegistry $registry) {
        parent::__construct($registry, News::class);
    }

    function findForLandingPage (): ?News {
        $latest = $this->createQueryBuilder('news')->orderBy('news.timePublish', 'DESC')->orderBy('news.id', 'DESC')->setMaxResults(1)->getQuery()->getResult();

        return $latest[0] ?? null;
    }

    /**
     * @return News[] Returns an array of News objects
     */
    function findForNewsPage (): ?array {
        return $this->createQueryBuilder('news')
            ->where('news.isPublished = 1')
            ->orderBy('news.timePublish', 'DESC')->orderBy('news.id', 'DESC')->setMaxResults(10)->getQuery()
            ->getResult();
    }

    /**
     * @return News[] Returns an array of News objects
     */
    function findForAdminPage (): ?array {
        return $this->createQueryBuilder('news')->orderBy('news.timePublish', 'DESC')->orderBy('news.id', 'DESC')->setMaxResults(50)->getQuery()->getResult();
    }


    // /**
    //  * @return News[] Returns an array of News objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?News
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
