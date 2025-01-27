<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitType extends Model
{
    protected $table = 'visit_type';
    protected $primaryKey = 'visit_type_id';
    public $timestamps = false;
//    public const CREATED_AT = 'visit_type_created_at';
//    public const UPDATED_AT = 'visit_type_updated_at';
}
