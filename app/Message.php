<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function conversation ()
    {
    	return $this->belongsTo(Conversation::class);
    }

    public function user_from ()
    {
    	return $this->belongsTo(User::class,'message_from');
    }

    public function user_to ()
    {
    	return $this->belongsTo(User::class,'message_to');
    }
}
