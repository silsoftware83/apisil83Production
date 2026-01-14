<?php

namespace Src\Employee\PersonalData\PersonalInformation\Application\UseCases;

use Src\Configuration\Company\DepartmentsAndPositions\Domain\Repositories\DepartmentsAndPositionsRepositoryInterface;
use Src\Employee\PersonalData\PersonalInformation\Domain\Exceptions\PersonalDataNotFoundException;
use Src\Employee\PersonalData\PersonalInformation\Domain\Exceptions\PersonalDataValidationException;
use Src\Employee\PersonalData\PersonalInformation\Domain\Repositories\PersonalDataRepositoryInterface;
use Illuminate\Support\Facades\Log;

class GetImmeditedBossAndDepartmentsUseCase
{
    private $repository;
    private $departmentRepository;
    public function __construct(PersonalDataRepositoryInterface $repository, DepartmentsAndPositionsRepositoryInterface $departmentRepository)
    {
        $this->repository = $repository;
        $this->departmentRepository = $departmentRepository;
    }

    public function execute(): array
    {
        try {
            $response = [];
            $personalActivo = $this->repository->activos();
            $response['personalActivo'] = $this->transformData($personalActivo);
            $departamentos = $this->departmentRepository->allDepartmentsWhithPositions();

            Log::info($departamentos);
            $response['departamentos'] = $this->formatDepartmentsResponse($departamentos);
            return $response;
        } catch (PersonalDataNotFoundException $e) {
            throw new PersonalDataNotFoundException($e->getMessage());
        } catch (PersonalDataValidationException $e) {
            throw new PersonalDataValidationException($e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function transformData($data): array
    {
        return collect($data)->map(function ($item) {
            return [
                'id' => $item['id'],
                'value' => $item['id'],
                'label' => $item['name'] . ' ' . $item['lastName'],

            ];
        })->toArray();
    }
    public function formatDepartmentsResponse($data): array
    {
        return collect($data)->map(function ($item) {
            return [
                'id' => $item['id'],
                'value' => $item['id'],
                'label' => $item['nombre'],
                'puestos' => $item['puestos'],

            ];
        })->toArray();
    }
}
