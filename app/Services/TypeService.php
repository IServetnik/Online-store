<?php

namespace App\Services;

use App\Repositories\TypeRepository as Repository;
use Illuminate\Http\Request;
use App\Models\Type as Model;
use App\Exceptions\TypeException;

class TypeService
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
        $data = array_map('strtolower', $request->all());

        if (!$this->checkName($data['category_name'], $data['name'])) throw new TypeException('Name is not unique');

        $result = Model::create($data);
        if(!$result) throw new TypeException("Something went wrong");

        return $result;
    }





    /**
     * getAll
     *
     * @return void
     */
    public function getAll()
    {
        $types = $this->repository->getAll();
        return $types;
    }
        
    /**
     * getByCategory
     *
     * @param  mixed $category
     * @return void
     */
    public function getByCategoryName(string $category_name)
    {
        $types = $this->repository->getByCategoryName($category_name);
        return $types;
    }

    /**
     * getById
     *
     * @param  mixed $id
     * @return void
     */
    public function getById(string $id)
    {
        $types = $this->repository->getById($id);
        return $types;
    }
        
    /**
     * getByName
     *
     * @param  string $name
     * @return void
     */
    public function getByName(string $name)
    {
        $type = $this->repository->getByName($name);
        return $type;
    }

    /**
     * getWhere
     *
     * @param  mixed $where
     * @return void
     */
    public function getWhere(array $where)
    {
        $types = $this->repository->getWhere($where);
        return $types;
    }

    



    /**
     * checkName
     *
     * @param  mixed $newName
     * @param  mixed $oldName
     * @return void
     */
    public function checkName(string $category_name, string $newName, string $oldName = null)
    {
        $category_name = strtolower($category_name);
        $newName = strtolower($newName);
        $oldName = strtolower($oldName);

        if ($newName === $oldName) return true;

        $types = $this->getByCategoryName($category_name);
        $types->transform(function ($item, $key) {return strtolower($item->name);});

        if ($types->search(strtolower($newName)) === false) return true;
        
        return false;
    }
}