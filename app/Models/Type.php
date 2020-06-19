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
}
