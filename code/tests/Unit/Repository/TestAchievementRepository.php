<?php

declare(strict_types=1);

namespace App\Tests\Unit\Repository;

use App\Entity\Achievement;
use App\Repository\AchievementRepositoryInterface;

class TestAchievementRepository implements AchievementRepositoryInterface
{
    public ?Achievement $savedAchievement = null;

    public function save(Achievement $achievement): void
    {
        $this->savedAchievement = $achievement;
    }
}
