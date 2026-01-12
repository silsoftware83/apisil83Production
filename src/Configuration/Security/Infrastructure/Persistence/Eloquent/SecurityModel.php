<?php

namespace Src\Configuration\Security\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class SecurityModel extends Model
{
    protected $table = 'configuration_security';
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
