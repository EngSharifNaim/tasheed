<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questionsandanswer extends Model
{
    protected $table = "questionsandanswers";
    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
