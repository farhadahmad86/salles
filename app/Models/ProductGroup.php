<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $table = 'product_group';
    protected $primaryKey = 'product_group_id';
    public $timestamps = false;
//    public const CREATED_AT = 'product_group_created_at';
//    public const UPDATED_AT = 'product_group_updated_at';
}
