<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use RecordsActivity;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function countrie ()
    {

    	return $this->belongsTo(Countrie::class);
   	
    }

   public function citie ()
   {

   	  return $this->belongsTo(Citie::class);
   	
   }
    public function users_addresse()
    {
        return $this->hasMany(Users_addresse::class);
    }
    public function cupon()
    {
        return $this->hasMany(Cupon::class);
    }
/*   public function user (){

      return $this->hasMany(User::class);

   }
   public function product ()
   {

   	  return $this->hasMany(Product::class);

   }*/
}
