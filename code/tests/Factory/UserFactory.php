<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\User;
use Zenstruck\Foundry\ModelFactory;

class UserFactory extends ModelFactory
{
    public function createNewObject(array $attributes = []): User
    {
        return $this->create($attributes)->object();
    }

    protected static function getClass(): string
    {
        return User::class;
    }

    protected function getDefaults(): array
    {
        return [
            'email' => 'johndoe@email.com'
        ];
    }

}
