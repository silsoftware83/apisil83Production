<?php

namespace Src\TimeAndLocation\Domain\Entities;

final class TimeAndLocation
{
    public function __construct(
        private ?int $id = null,
        private string $latitud,
        private string $longitud,
        private int $id_user,
        private string $time,
        private string $ip,
        private bool $cancheckoutnotary,
        private bool $isweb,
        private ?string $comments,
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getLatitud(): string
    {
        return $this->latitud;
    }

    public function getLongitud(): string
    {
        return $this->longitud;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getCancheckoutnotary(): bool
    {
        return $this->cancheckoutnotary;
    }

    public function getIsweb(): bool
    {
        return $this->isweb;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'id_user' => $this->id_user,
            'time' => $this->time,
            'ip' => $this->ip,
            'cancheckoutnotary' => $this->cancheckoutnotary,
            'isweb' => $this->isweb,
            'comments' => $this->comments,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }
}
