<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $table = 'town';
    protected $primaryKey = 'town_id';
    public $timestamps = false;
//    const CREATED_AT = 'town_created_at';
//    const UPDATED_AT = 'town_updated_at';
}
