<?php

namespace Src\Employee\PersonalData\Domain\Entities;

use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Departamento;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Puesto;

final class PersonalData
{
    public function __construct(
        private ?int $id = null,
        private ?string $actualContract = null,
        private ?string $dateContractFinish = null,
        private ?string $name = null,
        private ?string $lastName = null,
        private ?int $activo = null,
        private ?string $idCheck = null,
        private ?string $direction = null,
        private ?int $cp = null,
        private ?string $phone = null,
        private ?string $birthday = null,
        private ?string $rfc = null,
        private ?string $curp = null,
        private ?string $nss = null,
        private ?string $school = null,
        private ?string $ine = null,
        private ?string $alergist = null,
        private ?string $personalContact = null,
        private ?string $phoneContact = null,
        private ?string $empresa = null,
        private ?string $ingreso = null,
        private ?int $idEmpleado = null,
        private ?int $idJefeInmediato = null,
        private ?int $idDepartamento = null,
        private ?int $idPuesto = null,
        private ?string $inmBoss = null,
        private ?string $wArea = null,
        private ?string $infonavit = null,
        private ?string $numCart = null,
        private ?string $company = null,
        private ?string $idLicNum = null,
        private ?string $documents = null,
        private ?array $contracts = null,
        private ?string $documentsCompany = null,
        private ?string $removeColaborator = null,
        private ?string $img = null,
        private ?string $numExt = null,
        private ?string $utalla = null,
        private ?string $numCarttwo = null,
        private ?string $email = null,
        private ?string $emailCompany = null,
        private ?string $checkCode = null,
        private ?string $extTel = null,
        private ?int $createdBy = null,
        private ?int $updatedBy = null,
        private ?\DateTimeImmutable $createdAt = null,
        private ?\DateTimeImmutable $updatedAt = null,
        private ?Departamento $departamento = null,
        private ?Puesto $puesto = null,
    ) {}

    // Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActualContract(): ?string
    {
        return $this->actualContract;
    }

    public function getDateContractFinish(): ?\DateTimeImmutable
    {
        return $this->dateContractFinish;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getActivo(): ?int
    {
        return $this->activo;
    }

    public function getIdCheck(): ?\DateTimeImmutable
    {
        return $this->idCheck;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getBirthday(): ?\DateTimeImmutable
    {
        return $this->birthday;
    }

    public function getRfc(): ?string
    {
        return $this->rfc;
    }

    public function getCurp(): ?string
    {
        return $this->curp;
    }

    public function getNss(): ?string
    {
        return $this->nss;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function getIne(): ?string
    {
        return $this->ine;
    }

    public function getAlergist(): ?string
    {
        return $this->alergist;
    }

    public function getPersonalContact(): ?string
    {
        return $this->personalContact;
    }

    public function getPhoneContact(): ?string
    {
        return $this->phoneContact;
    }

    public function getEmpresa(): ?string
    {
        return $this->empresa;
    }

    public function getPuesto(): ?string
    {
        return $this->puesto;
    }

    public function getIngreso(): ?\DateTimeImmutable
    {
        return $this->ingreso;
    }

    public function getIdEmpleado(): ?int
    {
        return $this->idEmpleado;
    }

    public function getIdJefeInmediato(): ?int
    {
        return $this->idJefeInmediato;
    }

    public function getIdDepartamento(): ?int
    {
        return $this->idDepartamento;
    }

    public function getIdPuesto(): ?int
    {
        return $this->idPuesto;
    }

    public function getInmBoss(): ?string
    {
        return $this->inmBoss;
    }

    public function getWArea(): ?string
    {
        return $this->wArea;
    }

    public function getInfonavit(): ?string
    {
        return $this->infonavit;
    }

    public function getNumCart(): ?string
    {
        return $this->numCart;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function getIdLicNum(): ?string
    {
        return $this->idLicNum;
    }

    public function getDocuments(): ?string
    {
        return $this->documents;
    }

    public function getContracts(): ?array
    {
        return $this->contracts;
    }

    public function getDocumentsCompany(): ?string
    {
        return $this->documentsCompany;
    }

    public function getRemoveColaborator(): ?string
    {
        return $this->removeColaborator;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function getNumExt(): ?string
    {
        return $this->numExt;
    }

    public function getUtalla(): ?string
    {
        return $this->utalla;
    }

    public function getNumCarttwo(): ?string
    {
        return $this->numCarttwo;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getEmailCompany(): ?string
    {
        return $this->emailCompany;
    }

    public function getCheckCode(): ?string
    {
        return $this->checkCode;
    }

    public function getExtTel(): ?string
    {
        return $this->extTel;
    }

    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setActualContract(?string $actualContract): void
    {
        $this->actualContract = $actualContract;
    }

    public function setDateContractFinish(?\DateTimeImmutable $dateContractFinish): void
    {
        $this->dateContractFinish = $dateContractFinish;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setActivo(?int $activo): void
    {
        $this->activo = $activo;
    }

    public function setIdCheck(?\DateTimeImmutable $idCheck): void
    {
        $this->idCheck = $idCheck;
    }

    public function setDirection(?string $direction): void
    {
        $this->direction = $direction;
    }

    public function setCp(?int $cp): void
    {
        $this->cp = $cp;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function setBirthday(?\DateTimeImmutable $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function setRfc(?string $rfc): void
    {
        $this->rfc = $rfc;
    }

    public function setCurp(?string $curp): void
    {
        $this->curp = $curp;
    }

    public function setNss(?string $nss): void
    {
        $this->nss = $nss;
    }

    public function setSchool(?string $school): void
    {
        $this->school = $school;
    }

    public function setIne(?string $ine): void
    {
        $this->ine = $ine;
    }

    public function setAlergist(?string $alergist): void
    {
        $this->alergist = $alergist;
    }

    public function setPersonalContact(?string $personalContact): void
    {
        $this->personalContact = $personalContact;
    }

    public function setPhoneContact(?string $phoneContact): void
    {
        $this->phoneContact = $phoneContact;
    }

    public function setEmpresa(?string $empresa): void
    {
        $this->empresa = $empresa;
    }

    public function setPuesto(?string $puesto): void
    {
        $this->puesto = $puesto;
    }

    public function setIngreso(?\DateTimeImmutable $ingreso): void
    {
        $this->ingreso = $ingreso;
    }

    public function setIdEmpleado(?int $idEmpleado): void
    {
        $this->idEmpleado = $idEmpleado;
    }

    public function setIdJefeInmediato(?int $idJefeInmediato): void
    {
        $this->idJefeInmediato = $idJefeInmediato;
    }

    public function setIdDepartamento(?int $idDepartamento): void
    {
        $this->idDepartamento = $idDepartamento;
    }

    public function setIdPuesto(?int $idPuesto): void
    {
        $this->idPuesto = $idPuesto;
    }

    public function setInmBoss(?string $inmBoss): void
    {
        $this->inmBoss = $inmBoss;
    }

    public function setWArea(?string $wArea): void
    {
        $this->wArea = $wArea;
    }

    public function setInfonavit(?string $infonavit): void
    {
        $this->infonavit = $infonavit;
    }

    public function setNumCart(?string $numCart): void
    {
        $this->numCart = $numCart;
    }

    public function setCompany(?string $company): void
    {
        $this->company = $company;
    }

    public function setIdLicNum(?string $idLicNum): void
    {
        $this->idLicNum = $idLicNum;
    }

    public function setDocuments(?string $documents): void
    {
        $this->documents = $documents;
    }

    public function setContracts(?array $contracts): void
    {
        $this->contracts = $contracts;
    }

    public function setDocumentsCompany(?string $documentsCompany): void
    {
        $this->documentsCompany = $documentsCompany;
    }

    public function setRemoveColaborator(?string $removeColaborator): void
    {
        $this->removeColaborator = $removeColaborator;
    }

    public function setImg(?string $img): void
    {
        $this->img = $img;
    }

    public function setNumExt(?string $numExt): void
    {
        $this->numExt = $numExt;
    }

    public function setUtalla(?string $utalla): void
    {
        $this->utalla = $utalla;
    }

    public function setNumCarttwo(?string $numCarttwo): void
    {
        $this->numCarttwo = $numCarttwo;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setEmailCompany(?string $emailCompany): void
    {
        $this->emailCompany = $emailCompany;
    }

    public function setCheckCode(?string $checkCode): void
    {
        $this->checkCode = $checkCode;
    }

    public function setExtTel(?string $extTel): void
    {
        $this->extTel = $extTel;
    }

    public function setCreatedBy(?int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function setUpdatedBy(?int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    // Helper methods
    public function getNombreCompleto(): string
    {
        return trim("{$this->name} {$this->lastName}");
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'actualContract' => $this->actualContract,
            'dateContractFinish' => $this->dateContractFinish,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'activo' => $this->activo,
            'id_check' => $this->idCheck,
            'direction' => $this->direction,
            'cp' => $this->cp,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'rfc' => $this->rfc,
            'curp' => $this->curp,
            'nss' => $this->nss,
            'school' => $this->school,
            'ine' => $this->ine,
            'alergist' => $this->alergist,
            'personalContact' => $this->personalContact,
            'phoneContact' => $this->phoneContact,
            'empresa' => $this->empresa,
            'puesto' => $this->puesto,
            'ingreso' => $this->ingreso,
            'id_empleado' => $this->idEmpleado,
            'id_jefe_inmediato' => $this->idJefeInmediato,
            'id_departamento' => $this->idDepartamento,
            'id_puesto' => $this->idPuesto,
            'inmBoss' => $this->inmBoss,
            'wArea' => $this->wArea,
            'infonavit' => $this->infonavit,
            'numCart' => $this->numCart,
            'company' => $this->company,
            'idLicNum' => $this->idLicNum,
            'documents' => $this->documents,
            'contracts' => $this->contracts,
            'documentsCompany' => $this->documentsCompany,
            'removeColaborator' => $this->removeColaborator,
            'img' => $this->img,
            'numExt' => $this->numExt,
            'utalla' => $this->utalla,
            'numCarttwo' => $this->numCarttwo,
            'email' => $this->email,
            'emailCompany' => $this->emailCompany,
            'checkCode' => $this->checkCode,
            'ext_tel' => $this->extTel,
            'created_by' => $this->createdBy,
            'updated_by' => $this->updatedBy,
            'created_at' => $this->createdAt?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
            'nombre_completo' => $this->getNombreCompleto(),
        ];
    }
    public function toArrayLogin(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'id_jefe_inmediato' => $this->idJefeInmediato,
            'id_departamento' => $this->idDepartamento,
            'id_puesto' => $this->idPuesto,
            'nombre_completo' => $this->getNombreCompleto(),
            'departamento' => $this->departamento,
            'puesto' => $this->puesto,
        ];
    }
}
