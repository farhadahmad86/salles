<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $table = 'business_category';
    protected $primaryKey = 'business_category_id';
    public $timestamps = false;
//    public const CREATED_AT = 'business_category_created_at';
//    public const UPDATED_AT = 'business_category_updated_at';
}
