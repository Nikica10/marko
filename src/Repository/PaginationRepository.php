<?php

namespace App\Repository;

use App\Entity\Pagination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Pagination|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pagination|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pagination[]    findAll()
 * @method Pagination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaginationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pagination::class);
    }

    // /**
    //  * @return Pagination[] Returns an array of Pagination objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pagination
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */




    /**
     * @param int $page
     * @param int $limit
     *
     * @return array
     */
    public function getAllPosts($page = 1, $limit = 3)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('pg')
            ->from('App:Pagination', 'pg')
            ->orderBy('pg.id', 'DESC')
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @return int
     */
    public function getPostCount()
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder
            ->select('count(pg)')
            ->from('App:Pagination', 'pg');

        return $queryBuilder->getQuery()->getSingleScalarResult();
    }




}
