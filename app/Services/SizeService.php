<?php

namespace App\Services;

use App\Repositories\SizeRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Size as Model;
use App\Exceptions\SizeException as Exception;

class SizeService
{      
    private $repository;


    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = app(Repository::class);
    }


    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = Model::create($data);
        if(!$result) throw new Exception("Something went wrong");

        return $result;
    }
}