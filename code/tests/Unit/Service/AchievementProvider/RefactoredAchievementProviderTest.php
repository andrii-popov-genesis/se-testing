<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\AchievementProvider;

use App\Entity\Achievement;
use App\Entity\User;
use App\Entity\UserWeight;
use App\Service\AchievementProvider\RefactoredAchievementProvider;
use App\Tests\Unit\ProtectedPropertyTrait;
use App\Tests\Unit\Repository\TestUserWeightRepository;
use App\Tests\Unit\Specification\TestWeightDiffSpecification;
use PHPUnit\Framework\TestCase;

class RefactoredAchievementProviderTest extends TestCase
{
    use ProtectedPropertyTrait;

    public function testExpectsGetAchievement(): void
    {
        $user = new User('');
        self::setId($user, 1);

        $userWeightRepository = new TestUserWeightRepository();
        $userWeightRepository->expectedGetFirst = new UserWeight($user, 50000, new \DateTimeImmutable());

        $provider = new RefactoredAchievementProvider(
            $userWeightRepository,
            new TestWeightDiffSpecification(true),
        );

        $actual = $provider->getAchievement($user, new UserWeight($user, 70000, new \DateTimeImmutable()));

        self::assertInstanceOf(Achievement::class, $actual);
    }

    public function testExpectsDoesNotGetAchievement(): void
    {
        $user = new User('');
        self::setId($user, 1);

        $userWeightRepository = new TestUserWeightRepository();
        $userWeightRepository->expectedGetFirst = new UserWeight($user, 50000, new \DateTimeImmutable());

        $provider = new RefactoredAchievementProvider(
            $userWeightRepository,
            new TestWeightDiffSpecification(false),
        );

        $actual = $provider->getAchievement($user, new UserWeight($user, 70000, new \DateTimeImmutable()));

        self::assertNull($actual);
    }
}
