<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';
    protected $primaryKey = 'region_id';
    public $timestamps = false;
//    const CREATED_AT = 'reg_created_at';
//    const UPDATED_AT = 'reg_updated_at';
}
