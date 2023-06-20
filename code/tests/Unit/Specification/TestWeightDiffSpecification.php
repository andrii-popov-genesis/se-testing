<?php

declare(strict_types=1);

namespace App\Tests\Unit\Specification;

use App\Entity\WeightDiff;
use App\Specification\WeightDiffSpecificationInterface;

class TestWeightDiffSpecification implements WeightDiffSpecificationInterface
{
    public function __construct(public bool $expected = true)
    {
    }

    public function isSatisfiedBy(WeightDiff $weightDiff): bool
    {
        return $this->expected;
    }
}
