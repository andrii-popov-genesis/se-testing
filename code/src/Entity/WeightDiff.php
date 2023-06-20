<?php

declare(strict_types=1);

namespace App\Entity;

class WeightDiff
{
    public function __construct(private User $user, private int $weight)
    {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }
}
