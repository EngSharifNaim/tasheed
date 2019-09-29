<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{

    use RecordsActivity;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

	protected static function boot() {
        parent::boot();

        static::deleting(function($brand) { // before delete() method call this
             $brand->brand_section()->delete();
             // do the rest of the cleanup... 
        });
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function brand_section_list()
    {
        return $this->hasMany(Brand_section::class)->select('section_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class,'brand_id')->where('active' , 'yes' )->where('deleted_at' , null );
    }


}
