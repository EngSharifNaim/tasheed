<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer_detail extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function order (){

        return $this->belongsTo(Order::class);

    }
}
