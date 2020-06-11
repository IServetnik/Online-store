<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService as Service;
use App\Http\Requests\ProductRequest;
use App\Exceptions\ProductException;

class ProductController extends Controller
{
    private $service;


    /**
     * __construct
     *
     * @param  mixed $service
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->service = $service;

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
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->service->store($request);
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
        $product = $this->service->getByName($name);
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
        $product = $this->service->getByName($name);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $name)
    {   
        try {
            $this->service->update($request, $name);
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
            $this->service->destroy($name);
        } catch (ProductException $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }
        
        return redirect()->route('main')->with(['success' => 'Product deleted successfully.']);
    }
}
