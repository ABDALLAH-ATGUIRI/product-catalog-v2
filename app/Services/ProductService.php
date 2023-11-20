<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct($name, $description, $price, $image, $categoryIds)
    {
        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image,
        ];

        $product = $this->productRepository->create($data);
        $product->categories()->attach(str_split($categoryIds[0]));

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
}
