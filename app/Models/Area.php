<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'area_id';
    public $timestamps = false;
//    const CREATED_AT = 'area_created_at';
//    const UPDATED_AT = 'area_updated_at';
}
