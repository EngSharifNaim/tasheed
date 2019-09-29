<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{

    public $attributes = [ 'hits' => 0 ];
    public $timestamps = false;
    protected $fillable = [ 'ip', 'date' , 'month' ];
    protected $table = 'visitors';

    public static function boot() {
        // Any time the instance is updated (but not created)
        static::saving( function ($tracker) {
            $tracker->visit_time = date('H:i:s');
            $tracker->hits++;
        } );
    }

    public static function hit() {
        static::firstOrCreate([
                  'ip'   => $_SERVER['REMOTE_ADDR'],
                  'date' => date('Y-m-d'),
                  'month' => date('m'),
              ])->save();
    }
}
