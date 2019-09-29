<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favoriteable extends Model
{

   protected $table = 'favoriteables';

    protected $fillable = [
        'product_id',
        'favoriteable_id',
        'favoriteable_type',
    ];

    public function favoriteable()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
