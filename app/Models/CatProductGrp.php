<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatProductGrp extends Model
{
    protected $table = 'cat_product_grp';
    protected $primaryKey = 'cat_product_grp_id';
    public $timestamps = false;
//    public const CREATED_AT = 'product_price_created_at';
//    public const UPDATED_AT = 'product_price_updated_at';
}
