<?php

namespace Extensions\SupplierFax\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierFaxModel extends Model
{
    public $table = 'SupplierFax';
    protected $fillable = ['fax','supplier_id'];
}