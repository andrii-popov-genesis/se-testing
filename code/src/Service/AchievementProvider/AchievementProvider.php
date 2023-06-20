<?php

declare(strict_types=1);

namespace App\Service\AchievementProvider;

use App\Entity\Achievement;
use App\Entity\User;
use App\Entity\UserWeight;
use App\Repository\UserWeightRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

class AchievementProvider implements AchievementProviderInterface
{
    public function __construct(private UserWeightRepositoryInterface $userWeightRepository,)
    {
    }

    public function getAchievement(User $user, UserWeight $newWeight): Achievement
    {
        $firstWeight = $this->tryGetFirstWeight($user);
        if ($firstWeight->getWeightGrammes() - $newWeight->getWeightGrammes() >= 2000) {
            return Achievement::createForMinus2Kilo($user);
        }
    }

    protected function tryGetFirstWeight(User $user): UserWeight
    {
        try {
            return $this->userWeightRepository->getFirst($user->getId());
        } catch (EntityNotFoundException $e) {
            return new UserWeight($user, 70000, new \DateTimeImmutable());
        }
    }
}
