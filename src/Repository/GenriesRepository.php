<?php

namespace App\Repository;

use App\Entity\Genries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Genries>
 *
 * @method Genries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genries[]    findAll()
 * @method Genries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genries::class);
    }

//    /**
//     * @return Genries[] Returns an array of Genries objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Genries
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
