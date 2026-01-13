<?php

namespace Src\Employee\Directory\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class DirectoryModel extends Model
{
    protected $table = 'employee_directory';
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
