<?php

namespace App\Repository;

use App\Entity\UserLastSteps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserLastSteps|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserLastSteps|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserLastSteps[]    findAll()
 * @method UserLastSteps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserLastStepsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLastSteps::class);
    }

    // /**
    //  * @return UserLastSteps[] Returns an array of UserLastSteps objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserLastSteps
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
