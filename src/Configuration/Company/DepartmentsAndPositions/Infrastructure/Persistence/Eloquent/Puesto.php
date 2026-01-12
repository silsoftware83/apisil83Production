<?php

namespace Src\Configuration\Company\DepartmentsAndPositions\Infrastructure\Persistence\Eloquent;

use Src\Employee\PersonalData\Infrastructure\Persistence\Eloquent\PersonalDataModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Puesto extends Model
{
    use HasFactory;

    protected $fillable = [

        'nombre',
        'descripcion',
        'level',
        'id_departamento',

    ];

    /**
     * Relación con el departamento
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    /**
     * Relación con el personal que ocupa este puesto
     */
    public function personal(): HasMany
    {
        return $this->hasMany(PersonalDataModel::class, 'id_puesto')->where('activo', 1);;
    }

    /**
     * Scope para puestos activos
     */
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Scope para filtrar por nivel
     */
    public function scopePorNivel($query, $nivel)
    {
        return $query->where('nivel', $nivel);
    }

    /**
     * Accessor para el rango salarial formateado
     */
    public function getRangoSalarialAttribute(): string
    {
        if ($this->salario_min && $this->salario_max) {
            return '$' . number_format($this->salario_min, 2) . ' - $' . number_format($this->salario_max, 2);
        }
        return 'No especificado';
    }
}
