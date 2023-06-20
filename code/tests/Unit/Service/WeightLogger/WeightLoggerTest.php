<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\WeightLogger;

use App\Entity\Achievement;
use App\Entity\User;
use App\Repository\UserWeightRepositoryInterface;
use App\Service\WeightLogger\WeightLogger;
use App\Tests\Unit\Repository\TestAchievementRepository;
use App\Tests\Unit\Service\AchievementProvider\TestAchievementProvider;
use App\Tests\Unit\Service\CurrentDateFactory\TestCurrentDateFactory;
use PHPUnit\Framework\TestCase;

class WeightLoggerTest extends TestCase
{
    public function testExpectsAchievementAndWeightSaved(): void
    {
        $user = new User('qwe');
        $expectedAchievement = new Achievement($user, 'test');

        $userWeightRepository = $this->createMock(UserWeightRepositoryInterface::class);
        $achievementRepository = new TestAchievementRepository();
        $achievementProvider = new TestAchievementProvider($expectedAchievement);

        $weightLogger = new WeightLogger(
            $userWeightRepository,
            $achievementProvider,
            $achievementRepository,
            new TestCurrentDateFactory(),
        );

        $userWeightRepository->expects(self::once())->method('save');

        $weightLogger->logWeight($user, 1000);

        self::assertSame($expectedAchievement, $achievementRepository->savedAchievement);
        // self assert same $userWightRepository->savedWeight instance of UserWeight
    }
}
