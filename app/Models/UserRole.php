<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = 'user_role_id';
    public $timestamps = false;
//    public const CREATED_AT = 'user_role_created_at';
//    public const UPDATED_AT = 'user_role_updated_at';
}
