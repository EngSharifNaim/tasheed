<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Auth ;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Paidacount;
class User extends Authenticatable
{
    use HasApiTokens,LaratrustUserTrait,Notifiable; 
    use SoftDeletes;
    protected $dates = ['deleted_at'];

 //,RecordsActivity
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'active'  ,'location', 'email'  , 'token' ,'sitepercetage' , 'another_website_link' , 'level' , 'password','photo' , 'first_name' ,'last_name' ,'phone' ,'countrie_id' ,'citie_id' ,'region_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function message_from(){
        return $this->hasMany(Message::class,'message_from');
    }

    public function message_to(){
        return $this->hasMany(Message::class,'message_to');
    }

    public function conversation_from(){
        return $this->hasMany(Conversation::class,'by');
    }

    public function conversation_to(){
        return $this->hasMany(Conversation::class,'with');
    }

    public function conversation_list(){

        return $this->hasMany(Conversation::class,'with')->orWhere('by', Auth::user()->id);
    }

    /**
     * Get all activity for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paidacount(){
        return $this->hasMany(Paidacount::class,'user_id');
    }
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class , 'product_owner_id');
    }

    //reviews
    public function user_reviews()
    {
        return $this->hasMany(Review::class , 'user_id');
    }

    public function products_view()
    {
        return $this->hasMany(Products_view::class)->where('user_id' , Auth::user()->id );
    }

    public function users_addresse()
    {
        return $this->hasMany(Users_addresse::class)->whereDeletedAt(null)->orderBy('created_at')->where('user_id' , Auth::user()->id );
    }

    public function users_addresses()
    {
        return $this->hasMany(Users_addresse::class)->whereDeletedAt(null)->orderBy('created_at');
    }

    public function userActiveAddresse()
    {
        return $this->hasOne(Users_addresse::class)->whereDeletedAt(null)->where('active' , 'yes')->latest();;
    }

    public function order()
    {
        return $this->hasMany(Order::class)->whereDeletedAt(null)->orderBy('created_at')->where('user_id' , Auth::user()->id );
    }

    public function shiping()
    {
        return $this->hasMany(Shiping::class) ; //->whereDeletedAt(null)->orderBy('created_at')->where('user_id' , Auth::user()->id );
    }

    public function user_citie()
    {
        return $this->hasOne(Users_addresse::class)->where('active' , 'yes') ; //->whereDeletedAt(null)->orderBy('created_at')->where('user_id' , Auth::user()->id );
    }

    public function favorited()
    {
        return $this->morphToMany('App\Product', 'favoriteable')->orderBy('created_at');
    }


    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }

    public function companie()
    {
        return $this->hasOne(Companie::class ) ;
    }
    public function site_profit()
    {
        return $this->belongsTo(Siteprofit::class ) ;
    }
	    public function countrie (){

        return $this->belongsTo(Countrie::class);

    }
    public function citie (){

        return $this->belongsTo(Citie::class);

    }
    public function region (){

        return $this->belongsTo(Region::class);

    }

}
