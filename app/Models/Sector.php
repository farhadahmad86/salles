<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sector';
    protected $primaryKey = 'sector_id';
    public $timestamps = false;
//    const CREATED_AT = 'sec_created_at';
//    const UPDATED_AT = 'sec_updated_at';
}
