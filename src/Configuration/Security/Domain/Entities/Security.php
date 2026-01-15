<?php

namespace Src\Configuration\Security\Domain\Entities;

final class Security
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?string $last_seen = null,
        private ?int $id_personal = null,
        private ?bool $active = null,
        private ?string $passwordLetter = null,

        // TODO: Add domain properties
        private ?\DateTimeImmutable $createdAt = null,
        private ?\DateTimeImmutable $updatedAt = null,
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getLastSeen(): ?string
    {
        return $this->last_seen;
    }

    public function setLastSeen(string $last_seen): void
    {
        $this->last_seen = $last_seen;
    }

    public function getIdPersonal(): ?int
    {
        return $this->id_personal;
    }

    public function setIdPersonal(int $id_personal): void
    {
        $this->id_personal = $id_personal;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getPasswordLetter(): ?string
    {
        return $this->passwordLetter;
    }

    public function setPasswordLetter(string $passwordLetter): void
    {
        $this->passwordLetter = $passwordLetter;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    // TODO: Add getters and setters for domain properties

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'last_seen' => $this->last_seen,
            'id_personal' => $this->id_personal,
            'active' => $this->active,
            'passwordLetter' => $this->passwordLetter,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            // TODO: Add other properties
        ];
    }
}
