<?php

namespace App;

use Laratrust\Models\LaratrustPermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends LaratrustPermission
{
    use RecordsActivity;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //
}
