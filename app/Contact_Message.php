<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact_Message extends Model
{
    use RecordsActivity;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = 'contact_messages';
}
