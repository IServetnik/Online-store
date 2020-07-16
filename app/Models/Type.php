<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{   
    protected $fillable = [
        'name', 'category_name'
    ];

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_name', 'name');
    }
    
    /**
     * products
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'type_name', 'name')->where('category_name', $this->category_name);
    }
}
