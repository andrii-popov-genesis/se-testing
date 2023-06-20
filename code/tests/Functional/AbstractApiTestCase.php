<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Functional\AbstractKernelBrowserTestCase;

abstract class AbstractApiTestCase extends AbstractKernelBrowserTestCase
{
    use JwtAuthenticationTrait;

    protected const DEFAULT_HEADERS = [
        'CONTENT_TYPE' => 'application/json',
    ];

    /**
     * @param array<string, mixed>|string $request
     */
    public static function httpPost(string $uri, array|string $request): string
    {
        return self::httpWrite('POST', $uri, $request);
    }

    /**
     * @param array<string, mixed>|string $request
     */
    public static function httpPatch(string $uri, array|string $request): string
    {
        return self::httpWrite('PATCH', $uri, $request);
    }

    public static function httpGet(string $uri): string
    {
        static::$client->request('GET', $uri, [], [], self::DEFAULT_HEADERS);

        return static::$client->getResponse()->getContent();
    }

    /**
     * @param array<string, mixed>|string $request
     */
    protected static function httpWrite(string $method, string $uri, array|string $request): string
    {
        $request = \is_array($request) ? json_encode($request) : $request;
        static::$client->request($method, $uri, [], [], self::DEFAULT_HEADERS, $request);

        return static::$client->getResponse()->getContent();
    }
}
