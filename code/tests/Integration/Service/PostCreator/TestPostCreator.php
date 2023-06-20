<?php

declare(strict_types=1);

namespace App\Tests\Integration\Service\PostCreator;

use App\Service\PostCreator\PostCreatorInterface;

class TestPostCreator implements PostCreatorInterface
{
    public ?int $userId = null;
    public ?int $weightGrammes = null;

    public function createPost(int $userId, int $weightGrammes): void
    {
        $this->userId = $userId;
        $this->weightGrammes = $weightGrammes;
    }
}
