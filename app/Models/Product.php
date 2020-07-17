<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'old_price', 'category_name', 'type_name', 'brand', 'color', 'size_names'
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

    public function getSizeNamesArrayAttribute()
    {
        $size_names_array = explode(",",$this->size_names);
        $size_names_array = collect(array_map('trim', $size_names_array));
        
        return $size_names_array;
    }
}
