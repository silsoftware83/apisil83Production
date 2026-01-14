<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Application\DTOs\ListDepartmentsAndPositionsDTO;
use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;

final class ListDepartmentsAndPositionsUseCase
{
    public function __construct(
        private DepartmentsAndPositionsRepositoryInterface $repository,
        private PersonalDataRepositoryInterface $repositoryPersonal
    ) {}

    public function execute(ListDepartmentsAndPositionsDTO $dto): array
    {
        $entities = $this->repository->all();
        $personal = $this->repositoryPersonal->activosBasic();

        return [
            'departments' =>  $entities,
            'personal' => $personal
        ];
    }
}
