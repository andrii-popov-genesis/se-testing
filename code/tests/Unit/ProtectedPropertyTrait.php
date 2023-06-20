<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use ReflectionClass;

trait ProtectedPropertyTrait
{
    /**
     * @param array<mixed> $arguments
     */
    public function createObject(string $class, array $arguments = []): object
    {
        $reflection = new ReflectionClass($class);
        $instance = $reflection->newInstanceWithoutConstructor();
        foreach ($arguments as $property => $value) {
            $reflectionProperty = $reflection->getProperty($property);
            $reflectionProperty->setValue($instance, $value);
        }

        return $instance;
    }

    /**
     * @param mixed $value;
     */
    protected static function setProtectedAttr(object $object, string $property, $value): object
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($object, $value);

        return $object;
    }

    /**
     * @return mixed
     */
    public static function getProtectedAttrValue(object $object, string $property)
    {
        $reflection = new ReflectionClass($object);
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    protected static function setId(object $object, int $id): object
    {
        return self::setProtectedAttr($object, 'id', $id);
    }
}
