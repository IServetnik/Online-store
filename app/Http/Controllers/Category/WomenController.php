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
        $products = $this->productService->getByCategoryName(self::CATEGORY);
        $typesCollection = $this->categoryService->getByName(self::CATEGORY)->typesCollection;

        return view('product.showByCategory', compact('products'))
                                                    ->with('types', $typesCollection)
                                                    ->with('category', self::CATEGORY);
    }

           
    /**
     * show by type
     *
     * @param  mixed $request
     * @param  mixed $type
     * @return void
     */
    public function showByType(Request $request, $type)
    {
        $filters = $request->query();

        if(empty($filters)) {
            $products = $this->productService->getByCategoryNameAndType(self::CATEGORY, $type);
        } else {
            $products = $this->productService->getByFilter(array_merge($filters, ['category' => self::CATEGORY], compact('type')));
        }
        
        return view('product.showByType', compact('products', 'type'))
                                                    ->with('category', self::CATEGORY);
    }
}
