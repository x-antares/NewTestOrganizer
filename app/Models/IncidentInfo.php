<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncidentInfo extends AbstractUuidModel
{
    use HasFactory;

    protected $fillable = [
        'infoable_type',
        'infoable_id',
        'frequency',
        'push_id',
        'status'
    ];

    public function infoable()
    {
        return $this->morphTo();
    }
}
