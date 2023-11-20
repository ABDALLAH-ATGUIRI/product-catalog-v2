<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        $product = $this->model->create($data);

        $product->categories()->attach($data['categories']);

        return $product;
    }

    public function update($id, array $data)
    {
        $product = $this->model->find($id);

        if ($product) {
            $product->update($data);
            $product->categories()->sync($data['categories']);
            return $product;
        }

        return null;
    }

    public function delete($id)
    {
        $product = $this->model->find($id);

        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }

    public function search($category, $priceMin, $priceMax, $productName)
    {
        return  $this->model->when($category, function ($query) use ($category) {
            return $query->whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category);
            });
        })
            ->when($priceMin, function ($query) use ($priceMin) {
                return $query->where('price', '>=', $priceMin);
            })
            ->when($priceMax, function ($query) use ($priceMax) {
                return $query->where('price', '<=', $priceMax);
            })
            ->when($productName, function ($query) use ($productName) {
                return $query->where('name', 'like', '%' . $productName . '%');
            })
            ->get();
    }
}
