<?php

namespace Extensions\CustomBusinessRole\Models;

use Illuminate\Database\Eloquent\Model;

class CustomBusinessRoleModel extends Model
{
    protected $table = 'CustomBusinessRole';
    protected $fillable = [
        'role',
        'business_role_id'
    ];
}