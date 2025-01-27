<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TandC extends Model
{
    protected $table = 'term_and_condition';
    protected $primaryKey = 'tandc_id';
    public $timestamps = false;
//    public const CREATED_AT = 'tandc_created_at';
//    public const UPDATED_AT = 'tandc_updated_at';
}
