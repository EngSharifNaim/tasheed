<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Paidacount extends Model
{

    public function user ()    {

        return $this->belongsTo(User::class , 'user_id');
    }
public function paidacounttype(){
        return $this->belongsTo(paidacounttype::class,'type_id');
}
}
