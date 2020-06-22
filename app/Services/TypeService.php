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
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show(string $id)
    {
        $type = $this->getById($id);
        if(!$type) abort(404);

        return $type;
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(string $id)
    {
        $type = $this->getById($id);
        if(!$type) abort(404);

        return $type;
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $data = array_map('strtolower', $request->all());
        $type = $this->getById($id);

        if (!$this->checkName($data['category_name'], $data['name'], $type->name)) throw new TypeException('Name is not unique');
        
        //change type name and category name in products
        $productService = app(ProductService::class);
        $products = $productService->getByCategoryAndType($type->category_name, $type->name);

        $products->each(function ($item, $key) use($data) {
            $productData = ['type_name' => $data['name'],
                        'category_name' => $data['category_name']];
            $item->update($productData);
        });

        $result = $type->update($data);
        if(!$result) throw new ProductException("Something went wrong");

        return $result;
    }

    /**
     * destroy
     *
     * @param  mixed $name
     * @return void
     */
    public function destroy(string $id)
    {
        $type = $this->getById($id);

        //delete products
        $productService = app(ProductService::class);
        $products = $productService->getByCategoryAndType($type->category_name, $type->name);

        $products->each(function ($item, $key) {
            $item->delete();
        });

        $result = $type->delete();
        if(!$result) throw new ProductException("Something went wrong");

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
     * getAllUnique
     *
     * @return void
     */
    public function getAllUnique()
    {
        $types = $this->repository->getAllUnique();
        return $types;
    }
        
    /**
     * getByCategory
     *
     * @param  mixed $category
     * @return void
     */
    public function getByCategory(string $category_name)
    {
        $types = $this->repository->getByCategory($category_name);
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
     * getByCategoryAndName
     *
     * @param  mixed $category_name
     * @param  mixed $name
     * @return void
     */
    public function getByCategoryAndName(string $category_name, string $name)
    {
        $type = $this->repository->getByCategoryAndName($category_name, $name);
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

        $types = $this->getByCategory($category_name);
        $types->transform(function ($item, $key) {return strtolower($item->name);});

        if ($types->search(strtolower($newName)) === false) return true;
        
        return false;
    }
}