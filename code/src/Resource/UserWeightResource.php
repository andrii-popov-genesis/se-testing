<?php

declare(strict_types=1);

namespace App\Resource;

use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class UserWeightResource
{
    /** @var int */
    #[NotBlank]
    #[Type('int')]
    #[GreaterThan(30000)]
    public $weight;
}
