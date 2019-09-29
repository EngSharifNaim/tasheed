<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paidacount;
use App\Userlevel;
class paidacounttype extends Model
{
    public function paidacount(){
        return $this->hasMany(Paidacount::class,'type_id');
    }
    public function userlevel(){
        return$this->belongsTo(Userlevel::class,'user_type');
    }
}
