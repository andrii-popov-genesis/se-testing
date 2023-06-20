<?php

declare(strict_types=1);

namespace App\Tests\Unit\Specification;

use App\Entity\User;
use App\Entity\WeightDiff;
use App\Specification\TwoKiloWeightDiffSpecification;
use PHPUnit\Framework\TestCase;

class TwoKiloWeightDiffSpecificationTest extends TestCase
{
    /**
     * @dataProvider dataProviderIsSatisfied
     */
    public function testExpectsIsSatisfied(int $diff, bool $expected): void
    {
        $weightDiff = new WeightDiff(new User(''), $diff);
        $specification = new TwoKiloWeightDiffSpecification();

        self::assertSame($expected, $specification->isSatisfiedBy($weightDiff));
    }

    public function dataProviderIsSatisfied(): iterable
    {
        yield [1000, false];
        yield [2000, true];
        yield [3000, true];
    }
}
