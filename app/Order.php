<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function parent(){
        return $this->belongsTo(Order::class,'parent_id');
    }
    public function has_orders(){
        return $this->hasMany(Order::class,'parent_id')->where('parent_id' , '>' , 0);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dealer()
    {
        return $this->belongsTo(User::class , 'product_owner');
    }



    public function payfort_payment()
    {
        return $this->hasOne(Payfort_payment::class);
    }

    public function order_product()
    {
        return $this->hasMany(Order_product::class  ) ;
    }
    public function transfer_detail()
    {
        return $this->hasMany(Transfer_detail::class  ) ;
    }
    public function user_addresse()
    {
        return $this->belongsTo(Users_addresse::class , 'addresse_id'  ) ;
    }
    public function site_profit()
    {
        return $this->belongsTo(Site_profit::class ) ;
    }



}
