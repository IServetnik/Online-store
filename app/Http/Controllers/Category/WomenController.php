<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class WomenController extends Controller
{
    const CATEGORY = 'women';
    private $categoryService;
    private $productService;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->productService = app(ProductService::class);
    }

    /**
     * show by category
     *
     * @return void
     */
    public function showAll()
    {
        $products = $this->productService->getByCategory(self::CATEGORY);
        $types = $this->categoryService->getByName(self::CATEGORY)->types;

        return view('product.showByCategory', compact('products', 'types'))
                                                    ->with('category', self::CATEGORY);
    }

           
    /**
     * show by type
     *
     * @param  mixed $request
     * @param  mixed $type_name
     * @return void
     */
    public function showByType(Request $request, $type_name)
    {
        $filters = $request->query();

        if(empty($filters)) {
            $products = $this->productService->getByCategoryAndType(self::CATEGORY, $type_name);
        } else {
            $products = $this->productService->getByFilter(array_merge($filters, ['category' => self::CATEGORY, 'type' => $type_name]));
        }
        
        return view('product.showByType', compact('products'))
                                                    ->with('type', $type_name)
                                                    ->with('category', self::CATEGORY);
    }
}
