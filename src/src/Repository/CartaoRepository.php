<?php

namespace App\Repository;

use App\Entity\Cartao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cartao|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cartao|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cartao[]    findAll()
 * @method Cartao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cartao::class);
    }

    // /**
    //  * @return Cartao[] Returns an array of Cartao objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cartao
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
