<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyPocProfile extends Model
{
    protected $table = 'company_poc_profile';
    protected $primaryKey = 'com_poc_profile_id';
    public $timestamps = false;
//    const CREATED_AT = 'com_poc_profile_created_at';
//    const UPDATED_AT = 'com_poc_profile_updated_at';
}
