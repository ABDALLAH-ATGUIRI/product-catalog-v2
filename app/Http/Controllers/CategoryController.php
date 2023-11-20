<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryService $categoryService)
    {
        return response()->json(['categories' => $categoryService->getAllCategories()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryService $categoryService, CategoryRequest $categoryRequest)
    {
        return response()->json(['categories' => $categoryService->updateCategory($categoryRequest->name, $categoryRequest->parentId)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryService $categoryService, CategoryRequest $categoryRequest, string $id)
    {
        return response()->json(['categories' => $categoryService->createCategory($id, [$categoryRequest->name, $categoryRequest->parentId])]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryService $categoryService, string $categoryId)
    {
        return $categoryService->deleteCategory($categoryId);
    }
}
