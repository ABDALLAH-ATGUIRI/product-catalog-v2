<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
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

    public function getAllGroupedByParent()
    {
        return $this->model->with('children')->whereNull('parent_id')->get();
    }

    public function update($id, array $data)
    {
        $category = $this->model->find($id);

        if ($category) {
            $category->update($data);
            return $category;
        }

        return null;
    }

    public function delete($id)
    {
        $category = $this->model->find($id);

        if ($category) {
            $category->delete();
            return true;
        }

        return false;
    }
}
