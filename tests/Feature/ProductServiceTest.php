<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ProductService;
use App\Repositories\ProductRepository;
use Mockery;

class ProductServiceTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testCreateProduct()
    {
        // Arrange
        $productData = [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 19.99,
            'image' => 'C:\Users\Youcode\OneDrive\Images\PNG\49d63939-4600-43c0-9643-fb0e411dd94e.png',
            'categories' => [1, 2, 3],
        ];

        $repositoryMock = Mockery::mock(ProductRepository::class);
        $repositoryMock->shouldReceive('create')->once()->andReturn((object) $productData);

        $service = new ProductService($repositoryMock);

        // Act
        $result = $service->createProduct($productData);

        // Assert
        $this->assertEquals($productData['name'], $result->name);
        $this->assertEquals($productData['description'], $result->description);
        $this->assertEquals($productData['price'], $result->price);
        $this->assertEquals($productData['image'], $result->image);

        // Check if the 'categories' key exists in the result
        $this->assertTrue(isset($result->categories));
        // Check if the 'categories' key has the expected value
        $this->assertEquals($productData['categories'], $result->categories);
    }
}
