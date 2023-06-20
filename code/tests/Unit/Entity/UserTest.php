<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Entity\UserWeight;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testExpectsCreateWeight(): void
    {
        $user = new User('email');

        $actual = $user->createWeight(1000, new \DateTimeImmutable('2020-02-02'));

        self::assertEquals(
            new UserWeight($user,1000, new \DateTimeImmutable('2020-02-02')),
            $actual,
        );
    }
}
