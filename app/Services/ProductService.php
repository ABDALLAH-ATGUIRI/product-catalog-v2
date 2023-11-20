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
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'image' => ImageHelper::upload($request['image']),
        ];

        $product = $this->productRepository->create($data);
        $product->categories()->attach($request['categories']);

        return $product;
    }

    public function updateProduct(string $id, array $request)
    {
        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'image' => ImageHelper::upload($request['image']),
        ];

        $product = $this->productRepository->update($id, $data);
        $product->categories()->sync($request['categories']);

        return $product;
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
        // Retrieve filter parameters from the request
        $category = $request['category'];
        $priceMin = $request['price_min'];
        $priceMax = $request['price_max'];
        $productName = $request['name'];

        return $this->productRepository->search($category, $priceMin, $priceMax, $productName);
    }
}
