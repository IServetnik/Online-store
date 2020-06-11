<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Category extends Model
{
    public function getTypesCollectionAttribute() : Collection
    {
        $types = $this->types;
        
        $typesArray = explode(',', $types);
        //trim all types
        $typesArray = array_map(function($type) {return trim($type);}, $typesArray);

        $typesCollection = collect($typesArray);

        return $typesCollection;
    }
}
