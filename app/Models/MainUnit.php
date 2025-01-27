<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainUnit extends Model
{
    protected $table = 'main_unit';
    protected $primaryKey = 'main_unit_id';
    public $timestamps = false;
//    public const CREATED_AT = 'product_price_created_at';
//    public const UPDATED_AT = 'product_price_updated_at';
}
