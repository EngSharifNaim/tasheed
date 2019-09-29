<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth ;
class Products_view extends Model
{

    public $attributes = [ 'hits' => 0 ];
    public $timestamps = false;
    protected $fillable = [ 'ip', 'date' , 'month' , 'product_id' , 'user_id' ];
    protected $table = 'products_views';

    public static function boot() {
        // Any time the instance is updated (but not created)
        static::saving( function ($tracker) {
            $tracker->visit_time = date('H:i:s');
            $tracker->hits++;
        } );
    }

    public static function hit($product_id , $user_id ) {
        static::firstOrCreate([
            'ip'   => $_SERVER['REMOTE_ADDR'],
            'date' => date('Y-m-d'),
            'month' => date('m'),
            'product_id' => $product_id ,
            'user_id' =>  $user_id ,//(isset($user_id)) ? : 0 ,
        ])->save();
    }


    public function product()
    {
            return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
/*
    public function products()
    {
        if(!empty(Auth::user())){
            return $this->hasMany(Product::class)->where('user_id' , Auth::user()->id);
        }else{
            return $this->hasMany(Product::class)->where('ip' , $_SERVER['REMOTE_ADDR']);
        }
    }*/
 /*   public static function products()
    {
        if(Auth::user()){
            return $this->hasMany(Product::class)->where('user_id' , Auth::user()->id)->orWhere('ip' , $_SERVER['REMOTE_ADDR']);
        }else{
            return $this->hasMany(Product::class)->where('ip' , $_SERVER['REMOTE_ADDR']);

        }

    }*/
}
