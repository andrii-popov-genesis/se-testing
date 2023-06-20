<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Achievement;

interface AchievementRepositoryInterface
{
    public function save(Achievement $achievement): void;
}
