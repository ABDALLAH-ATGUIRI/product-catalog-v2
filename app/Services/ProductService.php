<?php

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }

    public function createProduct(array $request)
    {
        return $this->productRepository->create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'image' => ImageHelper::upload($request['image']),
            'categories' => $request['categories'],
        ]);
    }

    public function updateProduct(string $id, array $request)
    {
        return $this->productRepository->update($id, [
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'image' => ImageHelper::upload($request['image']),
        ]);
    }

    public function findOneProduct($id)
    {
        return $this->productRepository->find($id);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    public function searchProducts(array $request)
    {
        return $this->productRepository->search($request);
    }
}
