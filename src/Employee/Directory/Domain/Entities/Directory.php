<?php

namespace Src\Employee\Directory\Domain\Entities;

final class Directory
{
    public function __construct(
        private ?int $id = null,
        private ?string   $name,
        private ?string   $lastName,
        private ?string   $puesto,
        private ?string   $wArea,
        private ?string   $emailCompany,
        private ?string   $ext_tel,
        private ?string   $phone,
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getPuesto(): ?string
    {
        return $this->puesto;
    }

    public function getWArea(): ?string
    {
        return $this->wArea;
    }

    public function getEmailCompany(): ?string
    {
        return $this->emailCompany;
    }

    public function getExtTel(): ?string
    {
        return $this->ext_tel;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
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
            // TODO: Add other properties
        ];
    }
}
