<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $table = 'groups';
    protected $primaryKey = 'groups_id';
    public $timestamps = false;
}
