<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Achievement
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column()]
    private ?int $id = null;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: User::class)]
        private User $user,
        #[ORM\Column]
        private string $name,
    ) {
    }

    public static function createForMinus2Kilo(User $user): self
    {
        return new self($user, '-2 Kilos!');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
