<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measurements_unit extends Model
{
    use SoftDeletes;
    use RecordsActivity  ;
    protected $dates = ['deleted_at'];
    public function Products (){

        return $this->hasMany(Product::class);

    }
}
