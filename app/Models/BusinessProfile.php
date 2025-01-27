<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    protected $table = 'business_profile';
    protected $primaryKey = 'business_profile_id';
    public $timestamps = false;
//    public const CREATED_AT = 'business_profile_created_at';
//    public const UPDATED_AT = 'business_profile_updated_at';
}
