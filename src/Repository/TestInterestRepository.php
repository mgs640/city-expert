<?php

namespace App\Repository;

use App\Entity\Test;
use App\Entity\TestInterest;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TestInterest|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestInterest|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestInterest[]    findAll()
 * @method TestInterest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestInterestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestInterest::class);
    }

    public function getCount(Test $test, bool $isLiked): int
    {
        return $this->createQueryBuilder('interest')
            ->select('count(interest.id)')
            ->andWhere('IDENTITY(interest.test) = :test_id')
            ->andWhere('interest.isLiked = :isLiked')
            ->setParameters([
                'test_id' => $test->getId(),
                'isLiked' => $isLiked,
            ])
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function isUserLiked(User $user, Test $test): ?bool
    {
        $interestInfo = $this->createQueryBuilder('interest')
            ->select('interest.isLiked')
            ->andWhere('IDENTITY(interest.user) = :user_id')
            ->andWhere('IDENTITY(interest.test) = :test_id')
            ->setParameters([
                'user_id' => $user->getId(),
                'test_id' => $test->getId(),
            ])
            ->getQuery()
            ->getOneOrNullResult();

        return $interestInfo ? $interestInfo['isLiked'] : null;
    }
}