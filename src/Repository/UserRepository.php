<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByDateRange(?DateTime $startDate, ?DateTime $endDate)
    {
        $qb = $this->createQueryBuilder('u')
            ->join('u.country', 'c')
            ->addSelect('c');

        if ($startDate) {
            $qb->andWhere('u.dateOfBirth >= :startDate')
                ->setParameter('startDate', $startDate);
        }

        if ($endDate) {
            $qb->andWhere('u.dateOfBirth <= :endDate')
                ->setParameter('endDate', $endDate);
        }

        return $qb->getQuery()->getResult();
    }

}
