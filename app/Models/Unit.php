<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit';
    protected $primaryKey = 'unit_id';
    public $timestamps = false;
//    public const CREATED_AT = 'unit_created_at';
//    public const UPDATED_AT = 'unit_updated_at';
}
