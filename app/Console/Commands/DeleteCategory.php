<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Validator;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete a category by ID';

    /**
     * Execute the console command.
     */
    public function handle(CategoryService $categoryService)
    {
        $categoryId = $this->argument('id');

        $validator = Validator::make(['id' => $categoryId], [
            'id' => 'required|exists:categories,id',
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $this->error("Validation failed: " . implode(' ', $validator->errors()->all()));
            return;
        }

        if ($categoryService->deleteCategory($categoryId)) {
            $this->info("Category deleted successfully!");
        } else {
            $this->error("Category not found.");
        }
    }
}
