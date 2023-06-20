<?php

declare(strict_types=1);

namespace App\Service\PostCreator;

interface PostCreatorInterface
{
    public function createPost(int $userId, int $weightGrammes): void;
}
