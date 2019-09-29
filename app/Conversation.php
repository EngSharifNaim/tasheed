<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    public function message()
    {

    	return $this->hasMany(Message::class);

    }
    public function user_by ()
    {

    	return $this->belongsTo(User::class,'by');

    }

    public function user_with ()
    {

    	return $this->belongsTo(User::class,'with');
    	
    }

}
