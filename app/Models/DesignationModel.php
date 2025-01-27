<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationModel extends Model
{
    protected $table = 'designation';
    protected $primaryKey = 'designation_id';
    public $timestamps = false;
}
