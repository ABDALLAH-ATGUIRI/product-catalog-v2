<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory($name, $parentId)
    {
        return $this->categoryRepository->create(['name' => $name, 'parent_id' => $parentId]);
    }

    public function findOneCategory($id){
        return $this->categoryRepository->find($id);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
