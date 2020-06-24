<?php

namespace App\Repositories;

use App\Services\ProductService;
use Illuminate\Support\Collection;

class CartRepository
{             
    private $productService;


    public function __construct()
    {
        $this->productService = app(ProductService::class);
    }


    /**
     * getAll
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        $items = collect(session()->get("cart"));
        $items->transform(function ($item, $key) {
            return ['product' => $this->productService->getByName($key),
                    'quantity' => $item['quantity']
                ];
        });

        return $items;
    }
}