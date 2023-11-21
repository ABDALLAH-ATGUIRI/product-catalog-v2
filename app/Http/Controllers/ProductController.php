<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchRequest;
use App\Services\ProductService;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductService $productService)
    {
        return Inertia::render('Products/Index', ['products' => $productService->getAllProducts()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProductService $productService, ProductRequest $request)
    {
        return response()->json(['products' => $productService->createProduct($request->validated())]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductService $productService, $productId)
    {
        return response()->json(['products' => $productService->findOneProduct($productId)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductService $productService, ProductRequest $request, string $productId)
    {
        return response()->json(['products' => $productService->updateProduct($productId, $request->validated())]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductService $productService, string $productId)
    {
        return $productService->deleteProduct($productId);
    }

    /**
     * Search specified product.
     */
    public function search(ProductService $productService, SearchRequest $request)
    {
        return response()->json(['products' => $productService->searchProducts($request->validated())]);
    }
}
