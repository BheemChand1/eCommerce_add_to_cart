<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $fillable = ['product_id','name'];

    public function product(){
        return $this->belongsTo(Product::class);
        }
}
