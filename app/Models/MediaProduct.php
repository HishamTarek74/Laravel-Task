<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaProduct extends Model
{
    protected $table = 'mediaproducts';
    protected $primaryKey =  'id';
    protected $fillable = ['id', 'image' , 'IdProduct'];



    public function product()
    {

        return $this->belongsTo(\App\Models\Product::class);
    }

    public function getImageAttribute($val)
    {
        return ($val !== null) ? asset( $val) : "";

    }
}
