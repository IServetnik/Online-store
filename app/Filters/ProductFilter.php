<?php

namespace App\Filters;

use App\Models\Product as Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductFilter
{    
    private $builder;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->builder = Model::query();
    }

    /**
     * apply
     *
     * @param  mixed $filters
     * @return LengthAwarePaginator
     */
    public function apply(array $filters, $paginationCount = null) : LengthAwarePaginator
    {
        foreach($filters as $name => $value) {
            if (method_exists($this, $name) && $value !== null) {
                $this->$name($value);
            }
        }

        return $this->builder->groupBy('id')->paginate($paginationCount);
    }
    



    /**
     * min_price
     *
     * @param  mixed $value
     * @return void
     */
    public function min_price($value)
    {
        $this->builder->where('price', '>=', $value);
    }
    
    /**
     * max_price
     *
     * @param  mixed $value
     * @return void
     */
    public function max_price($value)
    {
        $this->builder->where('price', '<=', $value);
    }
    
    /**
     * discount
     *
     * @param  mixed $value
     * @return void
     */
    public function discount($value)
    {
        $this->builder->where('old_price', '!=', null);
    }
    
    /**
     * color
     *
     * @param  mixed $value
     * @return void
     */
    public function color($value)
    {
        $this->builder->select('products.*')->join('colors', function ($join) use ($value) {
                                    $join->on('products.id', '=', 'colors.product_id')->whereIn('colors.name', $value);
                                });
    }
    
    /**
     * brand
     *
     * @param  mixed $value
     * @return void
     */
    public function brand($value)
    {
        $this->builder->where('brand', 'like', "%$value%");
    }
        
    /**
     * name
     *
     * @param  mixed $value
     * @return void
     */
    public function name($value)
    {
        $this->builder->where('name', 'like', "%$value%");
    }

    /**
     * category
     *
     * @param  mixed $value
     * @return void
     */
    public function category($value)
    {
        $this->builder->where('category_name', $value);
    }
    
    /**
     * type
     *
     * @param  mixed $value
     * @return void
     */
    public function type($value)
    {
        $this->builder->where('type_name', $value);
    }
}