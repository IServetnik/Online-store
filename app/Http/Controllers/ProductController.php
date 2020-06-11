<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService as Service;
use App\Http\Requests\ProductCreateRequest;

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

        $this->middleware('isAdmin')->only('create');
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
    public function store(ProductCreateRequest $request)
    {
        if (!$this->service->checkType($request->category_name, $request->type)) return back()
                                                                                ->withErrors(["Incorrect type"])
                                                                                ->withInput();

        $result = $this->service->store($request);

        if(!$result) return back()
                        ->withErrors(["Something went wrong"])
                        ->withInput();

        return redirect()->route('main')->with(['success' => 'Product successfully created.']);
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
