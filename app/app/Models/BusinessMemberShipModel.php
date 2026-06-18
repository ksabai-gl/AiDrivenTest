<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessMemberShipModel extends Model
{
    //
    public $table = 'business_membership';
    protected $fillable = ['transaction','business_id','user_id',
        'type','start_contract_term',
        'end_contract_term','price','auto_renew','status'];
}
