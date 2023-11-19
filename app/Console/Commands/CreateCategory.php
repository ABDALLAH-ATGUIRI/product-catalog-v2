<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create {name} {--parent=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category';

    /**
     * Execute the console command.
     */
    public function handle(CategoryService $categoryService)
    {
        $name = $this->argument('name');
        $parentId = $this->option('parent');

        $validator = Validator::make(['name' => $name, 'parent_id' => $parentId], [
            'name' => 'required|string|max:255|unique:categories',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $this->error("Validation failed: " . implode(' ', $validator->errors()->all()));
            return;
        }

        $categoryService->createCategory($name, $parentId);

        $this->info("Category created successfully!");
    }
}
