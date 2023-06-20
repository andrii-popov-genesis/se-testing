<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\User;
use App\Repository\DoctrineUserRepository;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method static ContainerInterface getContainer()
 *
 * @property KernelBrowser $client
 */
trait JwtAuthenticationTrait
{
    protected static function getJwtAuthenticatedUserByEmail(
        string $email,
        string $jwtTokenManagerServiceId = 'lexik_jwt_authentication.jwt_manager'
    ): User {
        /** @var DoctrineUserRepository $userRepository */
        $userRepository = static::getContainer()->get(DoctrineUserRepository::class);

        $user = $userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            throw new Exception('user not found, email = '.$email);
        }

        self::authenticateUser($user, $jwtTokenManagerServiceId);

        return $user;
    }

    protected static function authenticateUser(
        User $user,
        string $jwtTokenManagerServiceId = 'lexik_jwt_authentication.jwt_manager'
    ): void {
        /** @var JWTTokenManagerInterface $tokenManager */
        $tokenManager = static::getContainer()->get($jwtTokenManagerServiceId);

        $token = $tokenManager->createFromPayload($user, [
            'email' => $user->getEmail(),
        ]);

        self::setBearerToken($token);
    }

    protected static function setBearerToken(string $token): void
    {
        self::$client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $token));
    }
}
