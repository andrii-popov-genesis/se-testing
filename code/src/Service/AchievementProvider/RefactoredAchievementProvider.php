<?php

declare(strict_types=1);

namespace App\Service\AchievementProvider;

use App\Entity\Achievement;
use App\Entity\User;
use App\Entity\UserWeight;
use App\Repository\UserWeightRepositoryInterface;
use App\Specification\WeightDiffSpecificationInterface;
use Doctrine\ORM\EntityNotFoundException;

class RefactoredAchievementProvider implements AchievementProviderInterface
{
    public function __construct(
        private UserWeightRepositoryInterface $userWeightRepository,
        private WeightDiffSpecificationInterface $weightDiffSpecification,
    ) {
    }

    public function getAchievement(User $user, UserWeight $newWeight): ?Achievement
    {
        $firstWeight = $this->tryGetFirstWeight($user);
        $weightDiff = $newWeight->subtract($firstWeight);

        if ($this->weightDiffSpecification->isSatisfiedBy($weightDiff)) {
            return Achievement::createForMinus2Kilo($user);
        }

        return null;
    }

    // цу нам трохи полегшує тестовий проєкт, щоб не морочитись з початковими даними сильно
    protected function tryGetFirstWeight(User $user): UserWeight
    {
        try {
            return $this->userWeightRepository->getFirst($user->getId());
        } catch (EntityNotFoundException $e) {
            return new UserWeight($user, 70000, new \DateTimeImmutable());
        }
    }
}
