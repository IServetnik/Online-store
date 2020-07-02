<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'old_price', 'category_name', 'type_name', 'brand', 'color', 'sizes'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_name', 'name');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_name', 'name')->where('category_name', $this->category_name);
    }

    public function getSizeCollectionAttribute()
    {
        $sizes = explode(",",$this->sizes);
        $sizes = collect(array_map('trim', $sizes));
        return $sizes;
    }
}
