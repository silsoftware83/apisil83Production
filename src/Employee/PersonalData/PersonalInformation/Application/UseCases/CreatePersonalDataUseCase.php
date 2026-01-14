<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\UseCases;

use Src\Employee\PersonalData\PersonalInformation\Application\DTOs\CreatePersonalDataDTO;
use Src\Employee\PersonalData\PersonalInformation\Application\DTOs\PersonalDataResponseDTO;
use Src\Employee\PersonalData\PersonalInformation\Domain\Entities\PersonalData;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class CreatePersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(CreatePersonalDataDTO $dto): PersonalDataResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Creating PersonalData', $dto->toArray());

            $entity = new PersonalData(
                actualContract: $dto->actualContract,
                dateContractFinish: $dto->dateContractFinish,
                name: $dto->name,
                lastName: $dto->lastName,
                activo: $dto->activo,
                idCheck: $dto->idCheck,
                direction: $dto->direction,
                cp: $dto->cp,
                phone: $dto->phone,
                birthday: $dto->birthday,
                rfc: $dto->rfc,
                curp: $dto->curp,
                nss: $dto->nss,
                school: $dto->school,
                ine: $dto->ine,
                alergist: $dto->alergist,
                personalContact: $dto->personalContact,
                phoneContact: $dto->phoneContact,
                empresa: $dto->empresa,
                ingreso: $dto->ingreso,
                idEmpleado: $dto->idEmpleado,
                idJefeInmediato: $dto->idJefeInmediato,
                idDepartamento: $dto->idDepartamento,
                idPuesto: $dto->idPuesto,
                inmBoss: $dto->inmBoss,
                wArea: $dto->wArea,
                infonavit: $dto->infonavit,
                numCart: $dto->numCart,
                company: $dto->company,
                idLicNum: $dto->idLicNum,
                documents: $dto->documents,
                contracts: $dto->contracts,
                documentsCompany: $dto->documentsCompany,
                removeColaborator: $dto->removeColaborator,
                img: $dto->img,
                numExt: $dto->numExt,
                utalla: $dto->utalla,
                numCarttwo: $dto->numCarttwo,
                email: $dto->email,
                emailCompany: $dto->emailCompany,
                checkCode: $dto->checkCode,
                extTel: $dto->extTel,
                createdBy: $dto->createdBy,
            );

            $entity = $this->repository->save($entity);

            Log::info('PersonalData created successfully', ['id' => $entity->getId()]);

            return PersonalDataResponseDTO::fromEntity($entity);
        });
    }
}
