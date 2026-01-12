<?php

namespace Src\Auth\Domain\Entities;

use Src\Employee\PersonalData\Domain\Entities\PersonalData;

final class User
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?string $email = null,
        private ?\DateTimeImmutable $createdAt = null,
        private ?\DateTimeImmutable $updatedAt = null,
        private ?PersonalData $persona = null,
        private ?int $id_personal = null,
        private ?\DateTimeImmutable $email_verified_at = null,
        private ?string $passwordLetter = null,
        private ?\DateTimeImmutable $last_seen = null,
        private ?string $device = null,
        private ?string $deviceOffice = null,
        private ?bool $cancheckoutnotary = null,
        private ?string $passwordactualizadopor = null,
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getPersona(): ?PersonalData
    {
        return $this->persona;
    }

    public function setPersona(PersonalData $persona): void
    {
        $this->persona = $persona;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_personal' => $this->id_personal,
            'name' => $this->name,
            'email' => $this->email,
            'persona' => $this->persona,
            'email_verified_at' => $this->email_verified_at?->format('Y-m-d H:i:s'),
            'passwordLetter' => $this->passwordLetter,
            'last_seen' => $this->last_seen?->format('Y-m-d H:i:s'),
            'device' => $this->device,
            'deviceOffice' => $this->deviceOffice,
            'cancheckoutnotary' => $this->cancheckoutnotary,
            'passwordactualizadopor' => $this->passwordactualizadopor,

        ];
    }
}
