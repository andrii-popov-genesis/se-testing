<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserWeight;
use Doctrine\ORM\EntityNotFoundException;

interface UserWeightRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function getFirst(int $userId): UserWeight;

    public function save(UserWeight $weight): void;
}
