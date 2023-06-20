<?php

declare(strict_types=1);

namespace App\Service\AchievementProvider;

use App\Entity\Achievement;
use App\Entity\User;
use App\Entity\UserWeight;

interface AchievementProviderInterface
{
    public function getAchievement(User $user, UserWeight $newWeight): ?Achievement;
}
