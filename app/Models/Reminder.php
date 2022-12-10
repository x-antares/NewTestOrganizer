<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reminder extends AbstractUuidModel
{
    use HasFactory;

    const TYPE_FUTURE = 0;
    const TYPE_DONE = 1;

    protected $fillable = [
        'user_id',
        'reminder_name',
        'color',
        'date'
    ];

    public function info()
    {
        return $this->morphOne(IncidentInfo::class, 'infoable');
    }
}
