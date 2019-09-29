<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shiping extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id', 'countrie_id', 'citie_id' , 'shiping_coast','h_w_for_shiping_coast' , 'coast_per_k_after_h_w'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function citie()
    {
        return $this->belongsTo(Citie::class);
    }
    public function countrie()
    {
        return $this->belongsTo(Countrie::class);
    }
}
