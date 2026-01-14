<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Src\Employee\PersonalData\PersonalInformation\Infrastructure\Persistence\Eloquent\PersonalDataModel;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Puesto;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_jefe_area',

    ];

    /**
     * Jefe del área (un empleado)
     */
    public function jefe(): BelongsTo
    {
        return $this->belongsTo(PersonalDataModel::class, 'id_jefe_area');
    }

    public function puestos(): HasMany
    {
        return $this->hasMany(Puesto::class, 'id_departamento');
    }
    /**
     * Personal que pertenece al departamento
     */
    public function personal()
    {
        return $this->hasMany(PersonalDataModel::class, 'id_departamento');
    }
}
