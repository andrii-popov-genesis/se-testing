<?php

declare(strict_types=1);

namespace App\Tests\Integration;

use Doctrine\DBAL\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method static ContainerInterface getContainer()
 */
trait DatabaseStateTestTrait
{
    protected static ?Connection $dataBaseConnection = null;

    protected static function getDataBaseConnection(): Connection
    {
        if (static::$dataBaseConnection) {
            return static::$dataBaseConnection;
        }

        return static::$dataBaseConnection = static::getContainer()->get(Connection::class);
    }
}
