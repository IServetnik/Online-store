<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\TypeService;
use App\Services\SizeService;
use App\Http\Requests\ProductRequest as Request;
use App\Exceptions\ProductException;

class ProductController extends Controller
{
    private $categoryService;
    private $productService;
    private $typeService;
    private $sizeService;

    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->productService = app(ProductService::class);
        $this->typeService = app(TypeService::class);
        $this->sizeService = app(SizeService::class);

        $this->middleware('isAdmin')->only(['create', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        $types = $this->typeService->getAllUnique();
        $sizes = $this->sizeService->getAll();

        return view('product.create', compact('categories', 'types', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->productService->store($request);
        } catch (ProductException $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        return redirect()->route('main')->with(['success' => 'Product created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $product = $this->productService->show($name);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($name)
    {
        $product = $this->productService->edit($name);
        $categories = $this->categoryService->getAll();
        $types = $this->typeService->getAllUnique();
        $sizes = $this->sizeService->getAll();

        return view('product.edit', compact('product', 'categories', 'types', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $name)
    {   
        try {
            $this->productService->update($request, $name);
        } catch (ProductException $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        return redirect()->route('main')->with(['success' => 'Product edited successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        try {
            $this->productService->destroy($name);
        } catch (ProductException $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }
        
        return redirect()->route('main')->with(['success' => 'Product deleted successfully.']);
    }
}
