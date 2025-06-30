<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','name', 'image', 'price', 'short_description', 'qty', 'sku', 'description'];

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function colors(){
        return $this->hasMany(ProductColor::class);
    }
}
