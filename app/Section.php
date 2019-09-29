<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use RecordsActivity;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

	public function product (){

		return $this->hasMany(Product::class);
	}

	public function product_main (){

		return $this->hasMany(Product::class , 'section_id' )->where('quantity' , '>' , 0)->where('deleted_at' , null );
	}
   	public function product_sub (){

		return $this->hasMany(Product::class , 'sub_section_id')->where('active' , 'yes')->where('quantity' , '>' , 0)->where('deleted_at' , null );
	}
   	public function product_sub_sub (){

		return $this->hasMany(Product::class , 'sub_sub_section_id')->where('quantity' , '>' , 0)->where('deleted_at' , null )->where('active' , 'yes');
	}

    //
    public function parent(){
        return $this->belongsTo(Section::class,'parent_id');
    }
    public function subsection(){
        return $this->belongsTo(Section::class,'sub_section');
    }
    public function has_sub(){
        return $this->hasMany(Section::class,'parent_id')->where('sub_section',0);
    }
    public function subsections(){
        return $this->hasMany(Section::class,'sub_section')->where('parent_id' , '>' , 0)->where('sub_section' , '>' , 0 );
    }

}
