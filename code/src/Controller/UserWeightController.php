<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Resource\UserWeightResource;
use App\Service\UseCase\LogWeightUseCase;
use App\Service\WeightLogger\WeightLoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserWeightController extends AbstractController
{
    public function __construct(
        private ValidatorInterface $validator,
        private SerializerInterface $serializer,
        private LogWeightUseCase $useCase
    ) {
    }

    #[Route('/user/weight', methods: ['POST'])]
    public function logWeight(Request $request): JsonResponse
    {
        $body = $this->parseBody($request);
        $this->useCase->execute($this->getAppUser(), $body->weight);

        return new JsonResponse(['a' => 'b'], 201);
    }

    protected function parseBody(Request $request): UserWeightResource
    {
        $resource = $this->serializer->deserialize($request->getContent(), UserWeightResource::class, 'json', [
            AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
        ]);

        $violations = $this->validator->validate($resource);

        if ($violations->count() > 0) {
            throw new BadRequestHttpException('Invalid request.');
        }

        return $resource;
    }

    protected function getAppUser(): User
    {
        $user = $this->getUser();

        if ($user instanceof User) {
            return $user;
        }

        throw new \RuntimeException();
    }
}
