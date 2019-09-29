<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function reviewable()
    {
        return $this->morphTo();
    }
    public function user()
    {
     return $this->belongsTo(User::class ) ;
    }
}
