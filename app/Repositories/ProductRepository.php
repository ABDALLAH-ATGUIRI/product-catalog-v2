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
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->model->find($id);

        if ($product) {
            $product->update($data);
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
}
