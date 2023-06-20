<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function boot(): void
    {
        parent::boot();

        // https://github.com/symfony/symfony/issues/35575
        if ($_SERVER['APP_DEBUG']) {
            $showDeprecations = $_ENV['APP_DEPRECATIONS'] ?? $_SERVER['APP_DEPRECATIONS'] ?? false;
            $showDeprecations = filter_var($showDeprecations, FILTER_VALIDATE_BOOLEAN);

            if (!$showDeprecations) {
                ErrorHandler::register(null, false)->setLoggers([
                    \E_DEPRECATED => [null],
                    \E_USER_DEPRECATED => [null],
                ]);
            }
        }
    }
}
