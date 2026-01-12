<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class DepartmentsAndPositionsModel extends Model
{
    protected $table = 'configuration_company_departments_and_positions';
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
