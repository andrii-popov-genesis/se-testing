<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class UserWeight
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column]
    private ?int $id = null;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: User::class)]
        private User $user,
        #[ORM\Column]
        private int $weightGrammes,
        #[ORM\Column]
        private \DateTimeImmutable $createdAt,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getWeightGrammes(): int
    {
        return $this->weightGrammes;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function subtract(UserWeight $other): WeightDiff
    {
        return new WeightDiff($this->user, $this->weightGrammes - $other->getWeightGrammes());
    }
}
