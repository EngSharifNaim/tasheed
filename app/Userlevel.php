<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\paidacounttype;
class Userlevel extends Model
{
    public function paidacounttype(){
        return $this->hasMany(\App\paidacounttype::class,'user_type');
    }
}
