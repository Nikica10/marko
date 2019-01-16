<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
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
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
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
//    public function getAllPosts($page = 1, $limit = 5)
//    {
//        $entityManager = $this->getEntityManager();
//        $queryBuilder = $entityManager->createQueryBuilder();
//        $queryBuilder
//            ->select('ar')
//            ->from('App:Articles', 'ar')
//            ->orderBy('ar.id', 'DESC')
//            ->setFirstResult($limit * ($page - 1))
//            ->setMaxResults($limit);
//
//        return $queryBuilder->getQuery()->getResult();
//    }
//
//    /**
//     * @return array
//     */
//    public function getPostCount()
//    {
//        $entityManager = $this->getEntityManager();
//        $queryBuilder = $entityManager->createQueryBuilder();
//        $queryBuilder
//            ->select('count(ar)')
//            ->from('App:Article', 'ar');
//
//        return $queryBuilder->getQuery()->getSingleScalarResult();
//    }
}
