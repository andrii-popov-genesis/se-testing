<?php

declare(strict_types=1);

namespace App\Tests\Unit\Service\CurrentDateFactory;

use App\Service\CurrentDateFactory\CurrentDateFactoryInterface;

class TestCurrentDateFactory implements CurrentDateFactoryInterface
{
    public ?\DateTimeImmutable $expected;

    public function __construct()
    {
        $this->expected = new \DateTimeImmutable('2020-02-02');
    }

    public function getCurrentDate(): \DateTimeImmutable
    {
        return $this->expected;
    }
}
