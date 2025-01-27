<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroupTarget extends Model
{
    protected $table = 'product_group_target';
    protected $primaryKey = 'product_group_target_id';
    public $timestamps = false;
//    public const CREATED_AT = 'product_group_target_created_at';
//    public const UPDATED_AT = 'product_group_target_updated_at';
}
