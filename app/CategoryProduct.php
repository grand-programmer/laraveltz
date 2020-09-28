<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'categoryproduct';
    protected $fillable=['category_id','product_id'];
}
