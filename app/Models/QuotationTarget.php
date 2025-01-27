<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationTarget extends Model
{
    protected $table = 'quotation_target';
    protected $primaryKey = 'quotation_target_id';
    public $timestamps = false;
//    public const CREATED_AT = 'quotation_target_created_at';
//    public const UPDATED_AT = 'quotation_target_updated_at';
}
