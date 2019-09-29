<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
	use RecordsActivity;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
	
    public function parent(){
    	return $this->belongsTo(Page::class,'parent_id');
    }
    public function sub(){
    	return $this->hasMany(Page::class,'parent_id');
    }
}
