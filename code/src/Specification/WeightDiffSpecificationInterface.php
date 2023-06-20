<?php

declare(strict_types=1);

namespace App\Specification;

use App\Entity\WeightDiff;

interface WeightDiffSpecificationInterface
{
    public function isSatisfiedBy(WeightDiff $weightDiff): bool;
}
