<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users_addresse extends Model
{

    protected $fillable = [
        'user_id', 'countrie_id' , 'lat' , 'lang' , 'citie_id' , 'region_id','addresse_ar' , 'addresse_en' ,'restrict_name_ar' ,'restrict_name_en' ,'mail_number' ,'active'
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    public function countrie (){

        return $this->belongsTo(Countrie::class);

    }
    public function citie (){

        return $this->belongsTo(Citie::class);

    }
    public function region (){

        return $this->belongsTo(Region::class);

    }
    public function user (){

        return $this->belongsTo(User::class);

    }
    public function order (){

        return $this->hasMany(Order::class );

    }

}
