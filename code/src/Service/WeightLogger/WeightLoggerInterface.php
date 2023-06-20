<?php

declare(strict_types=1);

namespace App\Service\WeightLogger;

use App\Entity\User;

interface WeightLoggerInterface
{
    public function logWeight(User $user, int $weight): void;
}
