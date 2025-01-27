<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunnelTarget extends Model
{
    protected $table = 'funnel_target';
    protected $primaryKey = 'funnel_target_id';
    public $timestamps = false;
//    public const CREATED_AT = 'funnel_target_created_at';
//    public const UPDATED_AT = 'funnel_target_updated_at';
}
