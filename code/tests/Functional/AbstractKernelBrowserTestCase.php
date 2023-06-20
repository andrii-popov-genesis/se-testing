<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class AbstractKernelBrowserTestCase extends WebTestCase
{
    protected static ?KernelBrowser $client = null;

    protected function setUp(): void
    {
        self::$client = self::createClient();
    }
}
