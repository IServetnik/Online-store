<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'old_price', 'category_name', 'type_name', 'brand', 'image_name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_name', 'name');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_name', 'name')->where('category_name', $this->category_name);
    }

    public function sizes()
    {
        return $this->hasMany(Size::class, 'product_id', 'id');
    }
}
