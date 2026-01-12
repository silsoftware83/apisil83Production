<?php

namespace Src\Employee\PersonalData\Infrastructure\Persistence\Eloquent;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Departamento;
use Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent\Puesto;

final class PersonalDataModel extends Model
{
    use HasFactory;
    protected $table = 'personal';
    protected $fillable = [
        'actualContract',
        'dateContractFinish',
        'name',
        'lastName',
        'activo',
        'id_check',
        'direction',
        'cp',
        'phone',
        'birthday',
        'rfc',
        'curp',
        'nss',
        'school',
        'ine',
        'alergist',
        'personalContact',
        'phoneContact',
        'empresa',
        'puesto',
        'ingreso',
        'id_empleado',
        'id_jefe_inmediato',
        'id_departamento',
        'id_puesto',
        'inmBoss',
        'wArea',
        'infonavit',
        'numCart',
        'company',
        'idLicNum',
        'documents',
        'contracts',
        'documentsCompany',
        'removeColaborator',
        'img',
        'numExt',
        'utalla',
        'numCarttwo',
        'email',
        'emailCompany',
        'checkCode',
        'ext_tel',
        'created_by',
        'updated_by',
        'activo',
    ];
    protected $appends = [
        'nombre_completo',
    ];

    protected $casts = [
        'dateContractFinish' => 'date',
        'id_check' => 'date',
        'birthday' => 'date',
        'ingreso' => 'date',
        'activo' => 'integer',
        'cp' => 'integer',
        'id_empleado' => 'integer',
        'id_jefe_inmediato' => 'integer',
        'id_departamento' => 'integer',
        'contracts' => 'array', // Para manejar el JSON automáticamente
    ];

    /**
     * Relación: Jefe inmediato (self-referencing)
     */
    // public function jefeInmediato()
    // {
    //     return $this->belongsTo(Personal::class, 'id_jefe_inmediato');
    // }
    /**
     * Departamento al que pertenece el empleado
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    /**
     * Relación: Empleados que reportan a este jefe
     */
    // public function subordinados()
    // {
    //     return $this->hasMany(Personal::class, 'id_jefe_inmediato');
    // }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_personal');
    }
    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'id_puesto');
    }

    /**
     * Scope: Solo empleados activos
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', 1);
    }

    /**
     * Scope: Por empresa
     */
    public function scopePorEmpresa($query, $empresa)
    {
        return $query->where('empresa', $empresa);
    }

    /**
     * Scope: Por departamento
     */
    public function scopePorDepartamento($query, $idDepartamento)
    {
        return $query->where('id_departamento', $idDepartamento);
    }

    /**
     * Accessor: Nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->name} {$this->lastName}";
    }

    /**
     * Accessor: Años de antigüedad
     */
    public function getAntiguedadAttribute()
    {
        if (!$this->ingreso) {
            return null;
        }
        return now()->diffInYears($this->ingreso);
    }
    /**
     * Accessor: Edad
     */
    public function getEdadAttribute()
    {
        if (!$this->birthday) {
            return null;
        }
        return now()->diffInYears($this->birthday);
    }

    public function scopeBasicInformation($query)
    {
        $query->select('id',  'name', 'lastName', 'id_puesto', 'id_departamento');
        return $query->where('activo', 1);
    }
}
