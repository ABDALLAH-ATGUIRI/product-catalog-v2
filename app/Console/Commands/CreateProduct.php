<?php

namespace App\Console\Commands;

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
        $data = [
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'price' => $this->argument('price'),
            'image' => $this->option('image'),
            'categories' => explode(',', $this->option('categories')[0]),
        ];

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string|max:255',
            'categories' => 'required|array|exists:categories,id',
        ]);

        try {
            $validator->validate();

            $product = $productService->createProduct($data);

            $this->info("Product created successfully! ID: {$product->id}");
        } catch (ValidationException $e) {
            $this->error("Validation failed: " . implode(' ', $validator->errors()->all()));
            return;
        }
    }
}
