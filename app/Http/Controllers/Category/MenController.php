<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class MenController extends Controller
{
    const CATEGORY = 'men';
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
        $category = self::CATEGORY;
        $products = $this->productService->getByCategoryName($category);
        $typesCollection = $this->categoryService->getByName($category)->typesCollection;

        return view('product.showByCategory', compact('products', 'category'))->with('types', $typesCollection);
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
        $category = self::CATEGORY;
        $filters = $request->query();

        if(empty($filters)) {
            $products = $this->productService->getByCategoryNameAndType($category, $type);
        } else {
            $products = $this->productService->getByFilter(array_merge($filters, compact('category'), compact('type')));
        }
        
        return view('product.showByType', compact('products', 'category', 'type'));
    }
}
