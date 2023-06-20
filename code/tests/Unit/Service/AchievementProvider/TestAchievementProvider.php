<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\AchievementProvider;

use App\Entity\Achievement;
use App\Entity\User;
use App\Entity\UserWeight;
use App\Service\AchievementProvider\AchievementProviderInterface;

class TestAchievementProvider implements AchievementProviderInterface
{
    public function __construct(public Achievement $expected)
    {
    }

    public function getAchievement(User $user, UserWeight $newWeight): Achievement
    {
        return $this->expected;
    }
}
