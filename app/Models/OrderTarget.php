<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderTarget extends Model
{
    protected $table = 'order_target';
    protected $primaryKey = 'order_target_id';
    public $timestamps = false;
//    public const CREATED_AT = 'order_target_created_at';
//    public const UPDATED_AT = 'order_target_updated_at';
}
