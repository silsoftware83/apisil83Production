<?php

namespace Src\TimeAndLocation\Application\DTOs;

use Src\TimeAndLocation\Domain\Exceptions\TimeAndLocationValidationException;

final class CreateTimeAndLocationDTO
{
    public function __construct(
        public string $latitud,
        public string $longitud,
        public int $id_user,
        public string $time,
        public string $ip,
        public bool $cancheckoutnotary,
        public bool $isweb,
        public ?string $comments,
        public ?string $type,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if (empty($this->latitud)) {
            throw new TimeAndLocationValidationException('Latitud is required');
        }
        if (empty($this->longitud)) {
            throw new TimeAndLocationValidationException('Longitud is required');
        }
        if (empty($this->id_user)) {
            throw new TimeAndLocationValidationException('Id_user is required');
        }
        if (empty($this->time)) {
            throw new TimeAndLocationValidationException('Time is required');
        }
        if (empty($this->ip)) {
            throw new TimeAndLocationValidationException('Ip is required');
        }
        if (empty($this->cancheckoutnotary)) {
            throw new TimeAndLocationValidationException('Cancheckoutnotary is required');
        }
        if (empty($this->isweb)) {
            throw new TimeAndLocationValidationException('Isweb is required');
        }
        if (empty($this->type)) {
            throw new TimeAndLocationValidationException('Type is required');
        }
    }

    public function toArray(): array
    {
        return [
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'id_user' => $this->id_user,
            'time' => $this->time,
            'ip' => $this->ip,
            'cancheckoutnotary' => $this->cancheckoutnotary,
            'isweb' => $this->isweb,
            'comments' => $this->comments ?? '',
            'type' => $this->type ?? '1',
        ];
    }
}
