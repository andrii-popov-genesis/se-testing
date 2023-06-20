<?php

declare(strict_types=1);

namespace App\Service\UseCase;

use App\Entity\User;
use App\Service\PostCreator\PostCreatorInterface;
use App\Service\WeightLogger\WeightLoggerInterface;
use Doctrine\ORM\EntityManagerInterface;

class LogWeightUseCase
{
    public function __construct(
        private WeightLoggerInterface $weightLogger,
        private PostCreatorInterface $postCreator,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function execute(User $user, int $weight): void
    {
        $this->weightLogger->logWeight($user, $weight);

        $this->postCreator->createPost($user->getId(), $weight);

        $this->entityManager->flush();
    }
}
