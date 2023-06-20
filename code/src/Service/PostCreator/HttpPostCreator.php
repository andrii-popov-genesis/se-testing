<?php

declare(strict_types=1);

namespace App\Service\PostCreator;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpPostCreator implements PostCreatorInterface
{
    public function __construct(private HttpClientInterface $httpClient)
    {
    }

    public function createPost(int $userId, int $weightGrammes): void
    {
        $this->httpClient->request('POST', 'https://jsonplaceholder.typicode.com/posts', [
            'json' => [
                'title' => 'I tracked my weight!',
                'body' => 'My weight is now ' . $weightGrammes,
                'userId' => $userId,
            ],
        ]);
    }
}
