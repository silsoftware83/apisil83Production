<?php

return [
    App\Providers\AppServiceProvider::class,
    Src\Auth\Infrastructure\Providers\AuthServiceProvider::class,
    Src\Employee\Directory\Infrastructure\Providers\DirectoryServiceProvider::class,
    Src\Employee\PersonalData\PersonalInformation\Infrastructure\Providers\PersonalDataServiceProvider::class,
    Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Providers\DepartmentsAndPositionsServiceProvider::class,
];
