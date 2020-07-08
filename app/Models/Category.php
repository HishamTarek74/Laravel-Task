<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
    ];

    public function products(){

        return $this -> hasMany('App\Models\Product','cat_id','id');
    }
}
