<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService as Service;
use App\Http\Requests\ProductCreateRequest;

class MainController extends Controller
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

        $this->middleware('isAdmin')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->service->getAll();
        return view('main', compact('products'));
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
    public function store(ProductCreateRequest $request)
    {
        if (!$this->service->checkType($request->category_name, $request->type)) return back()
                                                                                ->withErrors(["Incorrect type"])
                                                                                ->withInput();

        $result = $this->service->store($request);

        if(!$result) return back()
                        ->withErrors(["Something went wrong"])
                        ->withInput();

        return redirect()->route('main.index')->with(['success' => 'Product successfully created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
