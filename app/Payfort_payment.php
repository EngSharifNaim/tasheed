<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payfort_payment extends Model
{
    protected $table = 'order_payfort_payments' ;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
