<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository
    ) {}

    public function getProducts()
    {
        return $this->productRepository->getAll();
    }

    public function createProduct(
        array $data
    )
    {
        return $this->productRepository
            ->create($data);
    }
}