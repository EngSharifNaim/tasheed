<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cupon extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function countrie ()
    {

        return $this->belongsTo(Countrie::class);

    }
    public function citie ()
    {

        return $this->belongsTo(Citie::class);

    }
    public function region ()
    {

        return $this->belongsTo(Region::class);

    }
}
