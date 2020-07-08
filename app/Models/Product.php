<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title',
        'price',
        'image',
        'cat_id',
        'created_at',
        'updated_at',
    ];

    public function category()
    {

        return $this->belongsTo('App\Models\Category', 'cat_id', 'id');
    }

    public function getImageAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }

}
