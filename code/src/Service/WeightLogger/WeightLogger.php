<?php

declare(strict_types=1);

namespace App\Service\WeightLogger;

use App\Entity\User;
use App\Repository\AchievementRepositoryInterface;
use App\Repository\UserWeightRepositoryInterface;
use App\Service\AchievementProvider\AchievementProviderInterface;
use App\Service\CurrentDateFactory\CurrentDateFactoryInterface;

class WeightLogger implements WeightLoggerInterface
{
    public function __construct(
        private UserWeightRepositoryInterface $userWeightRepository,
        private AchievementProviderInterface $achievementProvider,
        private AchievementRepositoryInterface $achievementRepository,
        private CurrentDateFactoryInterface $currentDateFactory
    ) {
    }

    public function logWeight(User $user, int $weight): void
    {
        $weight = $user->createWeight(
            $weight,
            $this->currentDateFactory->getCurrentDate()
        );

        $this->userWeightRepository->save($weight);

        $achievement = $this->achievementProvider->getAchievement($user, $weight);

        if ($achievement) {
            $this->achievementRepository->save($achievement);
        }
    }
}
