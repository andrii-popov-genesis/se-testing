<?php

declare(strict_types=1);

namespace App\Service\CurrentDateFactory;

interface CurrentDateFactoryInterface
{
    public function getCurrentDate(): \DateTimeImmutable;
}
