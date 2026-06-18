<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseModel extends Model
{
    use SoftDeletes;
    //
    public $table = "warehouses";
    protected $fillable = ['name', 'address', 'deleted_at','business_id','active','created_by'];
}
