<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Achievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineAchievementRepository extends ServiceEntityRepository implements AchievementRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Achievement::class);
    }

    public function save(Achievement $achievement): void
    {
        $this->_em->persist($achievement);
    }
}
