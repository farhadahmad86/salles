<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleTarget extends Model
{
    protected $table = 'schedule_target';
    protected $primaryKey = 'sch_target_id';
    public $timestamps = false;
//    public const CREATED_AT = 'sch_target_created_at';
//    public const UPDATED_AT = 'sch_target_updated_at';
}
