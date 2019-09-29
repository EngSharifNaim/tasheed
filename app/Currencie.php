<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currencie extends Model
{
    use SoftDeletes;
    use RecordsActivity  ;
    protected $dates = ['deleted_at'];

}
