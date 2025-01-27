<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompProfile extends Model
{
    protected $table = 'company_profile';
    protected $primaryKey = 'comprofile_id';
    public $timestamps = false;
//    const CREATED_AT = 'comprofile_created_at';
//    const UPDATED_AT = 'comprofile_updated_at';
}
