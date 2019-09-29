<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countrie extends Model
{
    use RecordsActivity;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

   public function citie (){

   	return $this->hasMany(Citie::class);
   	
   }
   public function region (){

   	return $this->hasMany(Region::class);

   }
/*   public function user (){

   	return $this->hasMany(User::class);

   }*/

   public function product (){

      return $this->hasMany(Product::class);

   }
    public function users_addresse()
    {
        return $this->hasMany(Users_addresse::class);
    }
    public function cupon()
    {
        return $this->hasMany(Cupon::class);
    }
    public function shiping()
    {
        return $this->hasMany(Shiping::class) ; //->whereDeletedAt(null)->orderBy('created_at')->where('user_id' , Auth::user()->id );
    }
}
