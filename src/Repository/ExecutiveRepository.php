<?php

namespace App\Repository;

use App\Entity\Executive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Executive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Executive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Executive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExecutiveRepository extends ServiceEntityRepository {

    function __construct (ManagerRegistry $registry) {
        parent::__construct($registry, Executive::class);
    }

    /**
     * @return Executive[]|array
     */
    function findAll () {
        return $this->findBy([], ['sort' => 'ASC']);
    }

    /**
     * @return Executive[]
     */
    function findForImprint () {
        return array_filter(
            $this->createQueryBuilder('e')
                ->andWhere('e.sort IN (:val)')
                ->setParameter('val', [1, 2, 3])
                ->orderBy('e.sort', 'ASC')
                ->setMaxResults(3)
                ->getQuery()
                ->getResult(),
            function (Executive $e) {
                if (trim($e->getName()) === '---') {
                    return false;
                }

                return true;
            }
        );
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
