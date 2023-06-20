<?php

declare(strict_types=1);

namespace App\Service\CurrentDateFactory;

class CurrentDateFactory implements CurrentDateFactoryInterface
{
    public function getCurrentDate(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
