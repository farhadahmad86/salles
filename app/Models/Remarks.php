<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    protected $table = 'remarks';
    protected $primaryKey = 'remarks_id';
    public $timestamps = false;
//    const CREATED_AT = 'remarks_created_at';
//    const UPDATED_AT = 'remarks_updated_at';
}
