<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $table = 'reminder';
    protected $primaryKey = 'reminder_id';
    public $timestamps = false;
//    const CREATED_AT = 'reminder_created_at';
//    const UPDATED_AT = 'reminder_updated_at';
}
