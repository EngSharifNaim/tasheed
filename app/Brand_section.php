<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand_section extends Model
{
    //
	 protected $table = 'brand_section' ;
    protected $fillable = ['brand_id', 'section_id'];
    public $timestamps = false;
    use SoftDeletes;
    protected $dates = ['deleted_at'];


}
