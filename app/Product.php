<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable=['name'];
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
