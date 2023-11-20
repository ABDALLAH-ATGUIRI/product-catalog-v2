<?php

namespace App\Console\Commands;

use App\Helpers\ImageHelper;
use Illuminate\Console\Command;
use App\Services\ProductService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name} {description} {price} {--image=} {--categories=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new product';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $productService)
    {
        $name = $this->argument('name');
        $description = $this->argument('description');
        $price = $this->argument('price');
        $image = ImageHelper::upload($this->option('image'));
        $categoryIds = $this->option('categories');
        $validator = Validator::make(['name' => $name, 'description' => $description, 'price' => $price, 'image' => $image, 'categories' => $categoryIds], [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
            'categories' => 'required|array|exists:categories,id',
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $this->error("Validation failed: " . implode(' ', $validator->errors()->all()));
            return;
        }

        $product = $productService->createProduct($name, $description, $price, $image, $categoryIds);

        $this->info("Product created successfully! ID: {$product->id}");
    }
}
