<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Factory\UserFactory;
use Zenstruck\Foundry\Test\Factories;

class UserWeightControllerTest extends AbstractApiTestCase
{
    use Factories;

    public function testExpects201(): void
    {
        $user = UserFactory::new()->createNewObject();

        self::authenticateUser($user);

        self::httpPost('/api/user/weight', [
            'weight' => 50000,
        ]);

        self::assertResponseStatusCodeSame(201);
    }
}
