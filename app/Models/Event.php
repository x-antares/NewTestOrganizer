<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Event extends AbstractUuidModel
{
    use HasFactory;

    const TYPE_FUTURE = 0;
    const TYPE_DONE = 1;
    const TYPE_STARTED = 2;

    protected $fillable = [
        'user_id',
        'event_name',
        'color',
        'start_date',
        'end_date'
    ];

    public function info()
    {
        return $this->morphOne(IncidentInfo::class, 'infoable');
    }
}
