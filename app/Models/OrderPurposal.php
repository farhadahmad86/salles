<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPurposal extends Model
{
    protected $table = 'order_purposal';
    protected $primaryKey = 'order_purposal_id';
    public $timestamps = false;
//    const CREATED_AT = 'order_purposal_created_at';
//    const UPDATED_AT = 'order_purposal_updated_at';
}
