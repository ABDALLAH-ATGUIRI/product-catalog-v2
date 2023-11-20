<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Dotenv\Exception\ValidationException;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete {id : The ID of the product to delete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a product from the database';

    /**
     * Execute the console command.
     */
    public function handle(ProductService $productService)
    {
        $productId = $this->argument('id');

        $validator = Validator::make(['id' => $productId], [
            'id' => 'required|exists:products,id',
        ]);

        $product = $productService->findOneProduct($productId);

        if (!$product) {
            $this->error('Product not found.');
            return;
        }

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $this->error("Validation failed: " . implode(' ', $validator->errors()->all()));
            return;
        }

        if ($productService->deleteProduct($productId)) {
            $this->info("Category deleted successfully!");
        } else {
            $this->error("Category not found.");
        }
    }
}
