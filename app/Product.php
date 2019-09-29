<?php

namespace App;

use App\Http\Controllers\countries;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth ;
class Product extends Model
{
    //
    use RecordsActivity  ;
    use SoftDeletes;


    protected $table = 'products';
    protected $casts = [
        'color_id' => 'array',
        'size_id' => 'array',
    ];
    protected $dates = ['deleted_at'];

    public function user ()    {

        return $this->belongsTo(User::class , 'product_owner_id');
    }
    public function brands ()
    {
        return $this->belongsTo(Brand::class , 'brand_id');
    }
    public function colors ()
    {
        return $this->belongsTo(Color::class );
    }
    public function sizes ()
    {
        return $this->belongsTo(Size::class);
    }
    public function countries_products ()
    {
        return $this->belongsTo(Countrie::class , 'manfacture_country');
    }
    public function measurements_unit ()
    {
        return $this->belongsTo(Measurements_unit::class , 'measurements_unit_id');
    }
    public function mainsection ()
    {
        return $this->belongsTo(Section::class , 'section_id' )->where('parent_id' , '=' , 0)->where('sub_section' , '=' , 0 );
    }

    public function subsection ()
    {
        return $this->belongsTo(Section::class  , 'sub_section_id')->where('parent_id' , '!=' , 0)->where('sub_section' , '=' , 0 );
    }
    public function subsubsection ()
    {
        return $this->belongsTo(Section::class , 'sub_sub_section_id')->where('parent_id' , '!=' , 0)->where('sub_section' , '!=' , 0 );
    }
    public function reviews()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }
    public function review()
    {
        return $this->morphMany('App\Review', 'reviewable');
    }
    public function review1()
    {
        return $this->morphMany('App\Review', 'reviewable')->where('rating' , 1 );
    }
    public function review2()
    {
        return $this->morphMany('App\Review', 'reviewable')->where('rating' , 2 );
    }
    public function review3()
    {
        return $this->morphMany('App\Review', 'reviewable')->where('rating' , 3);
    }
    public function review4()
    {
        return $this->morphMany('App\Review', 'reviewable')->where('rating' , 4);
    }
    public function review5()
    {
        return $this->morphMany('App\Review', 'reviewable')->where('rating' , 5 );
    }

   /* public function product_reviews()
    {
        return $this->morphMany('App\Review', 'reviewable')->sum('rating');;
    }*/
    //products views according to auth or guest
    public function products_view()
    {
        return $this->hasMany(Products_view::class) ;
    }
    public function products_favourite()
    {
        return $this->hasMany(Favoriteable::class , 'product_id') ;
    }
}
