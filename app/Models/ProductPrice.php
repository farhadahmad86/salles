<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'product_price';
    protected $primaryKey = 'product_price_id';
    public $timestamps = false;
//    public const CREATED_AT = 'product_price_created_at';
//    public const UPDATED_AT = 'product_price_updated_at';
}
