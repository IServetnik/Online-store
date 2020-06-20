<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\TypeService;
use App\Http\Requests\TypeRequest;
use App\Exceptions\TypeException;

class TypeController extends Controller
{
    private $categoryService;
    private $typeService;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->categoryService = app(CategoryService::class);
        $this->typeService = app(TypeService::class);

        $this->middleware('isAdmin');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('type.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        try {
            $this->typeService->store($request);
        } catch (TypeException $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        return redirect()->route('main')->with(['success' => 'Type created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = $this->typeService->show($id);

        return view('type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = $this->typeService->edit($id);
        $categories = $this->categoryService->getAll();

        return view('type.edit', compact('type', 'categories'));
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
        try {
            $this->typeService->update($request, $id);
        } catch (TypeException $e) {
            return back()->withErrors([$e->getMessage()])->withInput();
        }

        return redirect()->route('main')->with(['success' => 'Type edited successfully.']);
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
