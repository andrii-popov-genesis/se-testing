<?php

declare(strict_types=1);

namespace App\Specification;

use App\Entity\WeightDiff;

class TwoKiloWeightDiffSpecification implements WeightDiffSpecificationInterface
{
    public function isSatisfiedBy(WeightDiff $weightDiff): bool
    {
        return $weightDiff->getWeight() >= 2000;
    }
}
