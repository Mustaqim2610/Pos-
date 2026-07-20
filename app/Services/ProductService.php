<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository
    ) {}

    public function __construct(
    protected ProductRepository $repository
    ) {}

    public function getProducts()
    {
        return $this->repository->getAll();
    }

    public function getProducts()
    {
        return $this->productRepository
            ->paginate();
    }

    public function createProduct(
        array $data
    )
    {
        return $this->productRepository
            ->create($data);
    }
}