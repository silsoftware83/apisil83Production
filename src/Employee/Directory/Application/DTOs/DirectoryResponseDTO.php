<?php

namespace Src\Employee\Directory\Application\DTOs;

final class DirectoryResponseDTO
{
    public function __construct(
        public readonly int $id,
        public ?string $name,
        public ?string $lastName,
        public ?string $puesto,
        public ?string $wArea,
        public ?string $emailCompany,
        public ?string $ext_tel,
        public ?string $phone,

    ) {}

    public static function fromEntity(\Src\Employee\Directory\Domain\Entities\Directory $entity): self
    {
        return new self(
            id: $entity->getId(),
            name: $entity->getName(),
            lastName: $entity->getLastName(),
            puesto: $entity->getPuesto(),
            wArea: $entity->getWArea(),
            emailCompany: $entity->getEmailCompany(),
            ext_tel: $entity->getExtTel(),
            phone: $entity->getPhone(),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'puesto' => $this->puesto,
            'wArea' => $this->wArea,
            'emailCompany' => $this->emailCompany,
            'ext_tel' => $this->ext_tel,
            'phone' => $this->phone,
        ];
    }
}
