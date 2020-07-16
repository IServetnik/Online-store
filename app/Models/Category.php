<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{        
    /**
     * types
     *
     * @return void
     */
    public function types()
    {
        return $this->hasMany(Type::class, 'category_name', 'name');
    }

    /**
     * products
     *
     * @return void
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_name', 'name');
    }
}
