<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\UseCases;

use Src\Employee\PersonalData\PersonalInformation\Application\DTOs\UpdatePersonalDataDTO;
use Src\Employee\PersonalData\PersonalInformation\Application\DTOs\PersonalDataResponseDTO;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class UpdatePersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(UpdatePersonalDataDTO $dto): PersonalDataResponseDTO
    {
        return DB::transaction(function () use ($dto) {
            Log::info('Updating PersonalData', ['id' => $dto->id]);

            $entity = $this->repository->find($dto->id);

            $entity->setActualContract($dto->actualContract);
            $entity->setDateContractFinish($dto->dateContractFinish);
            $entity->setName($dto->name);
            $entity->setLastName($dto->lastName);
            $entity->setActivo($dto->activo);
            $entity->setIdCheck($dto->idCheck);
            $entity->setDirection($dto->direction);
            $entity->setCp($dto->cp);
            $entity->setPhone($dto->phone);
            $entity->setBirthday($dto->birthday);
            $entity->setRfc($dto->rfc);
            $entity->setCurp($dto->curp);
            $entity->setNss($dto->nss);
            $entity->setSchool($dto->school);
            $entity->setIne($dto->ine);
            $entity->setAlergist($dto->alergist);
            $entity->setPersonalContact($dto->personalContact);
            $entity->setPhoneContact($dto->phoneContact);
            $entity->setEmpresa($dto->empresa);
            $entity->setIngreso($dto->ingreso);
            $entity->setIdEmpleado($dto->idEmpleado);
            $entity->setIdJefeInmediato($dto->idJefeInmediato);
            $entity->setIdDepartamento($dto->idDepartamento);
            $entity->setIdPuesto($dto->idPuesto);
            $entity->setInmBoss($dto->inmBoss);
            $entity->setWArea($dto->wArea);
            $entity->setInfonavit($dto->infonavit);
            $entity->setNumCart($dto->numCart);
            $entity->setCompany($dto->company);
            $entity->setIdLicNum($dto->idLicNum);
            $entity->setDocuments($dto->documents);
            $entity->setContracts($dto->contracts);
            $entity->setDocumentsCompany($dto->documentsCompany);
            $entity->setRemoveColaborator($dto->removeColaborator);
            $entity->setImg($dto->img);
            $entity->setNumExt($dto->numExt);
            $entity->setUtalla($dto->utalla);
            $entity->setNumCarttwo($dto->numCarttwo);
            $entity->setEmail($dto->email);
            $entity->setEmailCompany($dto->emailCompany);
            $entity->setCheckCode($dto->checkCode);
            $entity->setExtTel($dto->extTel);
            $entity->setUpdatedBy($dto->updatedBy);

            $entity = $this->repository->save($entity);

            Log::info('PersonalData updated successfully', ['id' => $entity->getId()]);

            return PersonalDataResponseDTO::fromEntity($entity);
        });
    }
}
