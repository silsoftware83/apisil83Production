<?php

namespace Src\TimeAndLocation\Application\DTOs;

final class TimeAndLocationResponseDTO
{
    public function __construct(
        public readonly int $id,
        public readonly float $latitud,
        public readonly float $longitud,
        public readonly int $id_user,
        public readonly string $time,
        public readonly string $ip,
        public readonly string $type,
        public readonly bool $cancheckoutnotary,
        public readonly bool $isweb,
        public readonly string $comments,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
    ) {}

    public static function fromEntity(\Src\TimeAndLocation\Domain\Entities\TimeAndLocation $entity): self
    {
        return new self(
            id: $entity->getId(),
            latitud: $entity->getLatitud(),
            longitud: $entity->getLongitud(),
            id_user: $entity->getIdUser(),
            time: $entity->getTime(),
            ip: $entity->getIp(),
            type: $entity->getType(),
            cancheckoutnotary: $entity->getCancheckoutnotary(),
            isweb: $entity->getIsweb(),
            comments: $entity->getComments(),
            createdAt: $entity->getCreatedAt()?->format('Y-m-d H:i:s'),
            updatedAt: $entity->getUpdatedAt()?->format('Y-m-d H:i:s'),
        );
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
            'type' => $this->type,
            'cancheckoutnotary' => $this->cancheckoutnotary,
            'isweb' => $this->isweb,
            'comments' => $this->comments,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }
}
