<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\WeightLogger;

use App\Service\UseCase\LogWeightUseCase;
use App\Tests\Factory\UserFactory;
use App\Tests\Integration\DatabaseStateTestTrait;
use App\Tests\Integration\Service\PostCreator\TestPostCreator;
use App\Tests\Unit\Service\CurrentDateFactory\TestCurrentDateFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\Factories;

class LogWeightUseCaseTest extends KernelTestCase
{
    use Factories;
    use DatabaseStateTestTrait;

    public function testExpectsSaveToDb(): void
    {
        $user = UserFactory::new()->createNewObject();

        /** @var LogWeightUseCase $useCase */
        $useCase = self::getContainer()->get(LogWeightUseCase::class);

        /** @var TestCurrentDateFactory $dateFactory */
        $dateFactory = self::getContainer()->get(TestCurrentDateFactory::class);
        $dateFactory->expected = new \DateTimeImmutable('2020-02-21');

        $useCase->execute($user, 6000);

        $actualUserWeight = self::getDataBaseConnection()->fetchAllAssociative('select * from user_weight');

        self::assertNotEmpty($actualUserWeight);
    }

    public function testExpectsCreatePost(): void
    {
        $user = UserFactory::new()->createNewObject();

        /** @var LogWeightUseCase $useCase */
        $useCase = self::getContainer()->get(LogWeightUseCase::class);

        /** @var TestCurrentDateFactory $dateFactory */
        $dateFactory = self::getContainer()->get(TestCurrentDateFactory::class);
        $dateFactory->expected = new \DateTimeImmutable('2020-02-21');

        $useCase->execute($user, 6000);

        /** @var TestPostCreator $postCreator */
        $postCreator = self::getContainer()->get(TestPostCreator::class);

        self::assertNotEmpty($postCreator->userId);
        self::assertSame(6000, $postCreator->weightGrammes);
    }
}
