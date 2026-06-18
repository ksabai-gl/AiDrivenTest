<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtensionModel extends Model
{
    //
    public $table = "extensions";
    protected $fillable = [
        'name', 
        'version', 
        'directory',
        'status',
        'email',
        'author',
        'description',
        'support_version',
        'verified',
        'icon'
    ];
}
