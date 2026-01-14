<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\DTOs;

use Src\Employee\PersonalData\PersonalInformation\Domain\Exceptions\PersonalDataValidationException;

final class UpdatePersonalDataDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $actualContract = null,
        public readonly ?string $dateContractFinish = null,
        public readonly ?string $name = null,
        public readonly ?string $lastName = null,
        public readonly ?int $activo = null,
        public readonly ?string $idCheck = null,
        public readonly ?string $direction = null,
        public readonly ?int $cp = null,
        public readonly ?string $phone = null,
        public readonly ?string $birthday = null,
        public readonly ?string $rfc = null,
        public readonly ?string $curp = null,
        public readonly ?string $nss = null,
        public readonly ?string $school = null,
        public readonly ?string $ine = null,
        public readonly ?string $alergist = null,
        public readonly ?string $personalContact = null,
        public readonly ?string $phoneContact = null,
        public readonly ?string $empresa = null,
        public readonly ?string $ingreso = null,
        public readonly ?int $idEmpleado = null,
        public readonly ?int $idJefeInmediato = null,
        public readonly ?int $idDepartamento = null,
        public readonly ?int $idPuesto = null,
        public readonly ?string $inmBoss = null,
        public readonly ?string $wArea = null,
        public readonly ?string $infonavit = null,
        public readonly ?string $numCart = null,
        public readonly ?string $company = null,
        public readonly ?string $idLicNum = null,
        public readonly ?string $documents = null,
        public readonly ?array $contracts = null,
        public readonly ?string $documentsCompany = null,
        public readonly ?string $removeColaborator = null,
        public readonly ?string $img = null,
        public readonly ?string $numExt = null,
        public readonly ?string $utalla = null,
        public readonly ?string $numCarttwo = null,
        public readonly ?string $email = null,
        public readonly ?string $emailCompany = null,
        public readonly ?string $checkCode = null,
        public readonly ?string $extTel = null,
        public readonly ?int $updatedBy = null,
    ) {
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->id <= 0) {
            throw new PersonalDataValidationException('Invalid ID');
        }
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
            'updated_by' => $this->updatedBy,
        ];
    }
}
