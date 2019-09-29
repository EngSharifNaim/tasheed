<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companie extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id', 'name_ar', 'name_en' , 'email','phone' , 'tax_number' ,'commercial_register'  , 'bank_name' , 'acount_bank_number' ,'company_website'
    ];

    public function user()
    {
        return $this->belongsTo(User::class );
    }
}
