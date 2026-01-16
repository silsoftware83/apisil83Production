<?php

namespace Src\TimeAndLocation\Infrastructure\Persistence\Eloquent;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TimeAndLocationModel extends Model
{
    protected $table = 'locations_asistences';
    protected $fillable = [
        'id_user',
        'comments',
        'latitud',
        'longitud',
        'time',
        'type',
        'isweb',
        'ip',
        'cancheckoutnotary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_personal');
    }



    public function getIsWebAttribute()
    {
        return $this->attributes['isweb'] === 1;
    }
}
