<?php

namespace App\Services;

use App\Repositories\ColorRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Color as Model;
use App\Exceptions\ColorException as Exception;

class ColorService
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
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $colors = $this->repository->getAll();
        return $colors;
    }

    /**
     * getById
     *
     * @param  mixed $id
     * @return void
     */
    public function getById(string $id)
    {
        $color = $this->repository->getById($id);
        return $color;
    }
        
    /**
     * getByName
     *
     * @param  string $name
     * @return void
     */
    public function getByName(string $name)
    {
        $color = $this->repository->getByName($name);
        return $color;
    }
 
    /**
     * getWhere
     *
     * @param  mixed $where
     * @return void
     */
    public function getWhere(array $where)
    {
        $colors = $this->repository->getWhere($where);
        return $colors;
    }
}