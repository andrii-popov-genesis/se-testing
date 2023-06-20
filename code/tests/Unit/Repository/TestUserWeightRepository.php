<?php

declare(strict_types=1);

namespace App\Tests\Unit\Repository;

use App\Entity\UserWeight;
use App\Repository\UserWeightRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

class TestUserWeightRepository implements UserWeightRepositoryInterface
{
    public ?UserWeight $expectedGetFirst = null;

    public function getFirst(int $userId): UserWeight
    {
        return $this->expectedGetFirst;
    }

    public function save(UserWeight $weight): void
    {
        // TODO: Implement save() method.
    }
}
