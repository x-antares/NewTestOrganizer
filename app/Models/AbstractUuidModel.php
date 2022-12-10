<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class AbstractUuidModel extends Model
{
    use UUID;

    public $incrementing = false;
}
