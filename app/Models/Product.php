<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'created_at',
        'updated_at',
    ];

    public function images(){

        return $this -> hasMany(\App\Models\MediaProduct::class , 'IdProduct');
    }


    public function getImageAttribute($val)
    {
        return ($val !== null) ? asset( $val) : "";

    }

}
