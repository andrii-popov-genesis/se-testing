<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserWeight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineUserWeightRepository extends ServiceEntityRepository implements UserWeightRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserWeight::class);
    }

    /** {@inheritDoc} */
    public function getFirst(int $userId) : UserWeight
    {
        $userWeight = $this->findOneBy(['user' => $userId], ['createdAt' => 'ASC']);

        if (null === $userWeight) {
            throw new EntityNotFoundException('No user weight logs found.');
        }

        return $userWeight;
    }

    public function save(UserWeight $weight): void
    {
        $this->_em->persist($weight);
    }
}
