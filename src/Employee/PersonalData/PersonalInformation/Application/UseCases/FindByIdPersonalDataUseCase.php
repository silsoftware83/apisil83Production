<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\UseCases;

use Src\Employee\PersonalData\PersonalInformation\Domain\Entities\PersonalData;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;

class FindByIdPersonalDataUseCase
{
    public function __construct(
        private PersonalDataRepositoryInterface $repository
    ) {}

    public function execute(int $id): PersonalData
    {
        return $this->repository->find($id);
    }
}
