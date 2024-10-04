<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ProductApiTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    // Teste para listar todos os produtos.
    public function testCanListProducts()
    {
        \App\Models\Product::factory(10)->create();
        $this->get('/api/products');
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            '*' => [
                'id', 'name', 'price', 'description', 'photo', 'created_at', 'updated_at'
            ]
        ]);
    }

    // Teste para criar um produto.
    public function testCanCreateProduct()
    {
        $data = [
            'name' => 'Sample Product',
            'price' => 20.99,
            'description' => 'This is a sample product description.',
            'photo' => UploadedFile::fake()->image('product.jpg'),
        ];

        $response = $this->post('/api/products', $data);
        $response->assertResponseStatus(201);
        $this->seeInDatabase('products', ['name' => 'Sample Product']);
    }

    // Teste para atualizar um produto.
    public function testCanUpdateProduct()
    {
        $product = \App\Models\Product::factory()->create();
        $data = [
            'name' => 'Updated Product',
            'price' => 25.99,
            'description' => 'Updated description.',
        ];

        $this->put("/api/products/{$product->id}", $data);
        $this->seeStatusCode(200);
        $this->seeJson([
            'id' => $product->id,
            'name' => 'Updated Product',
            'price' => '25.99',
            'description' => 'Updated description.'
        ]);
    }

    // Teste para deletar um produto (soft delete).
    public function testCanSoftDeleteProduct()
    {
        $product = \App\Models\Product::factory()->create();
        $this->delete("/api/products/{$product->id}");
        $this->seeStatusCode(204);
        
        // Verifica se o produto foi soft deleted
        $this->seeInDatabase('products', [
            'id' => $product->id,
        ]);
        
        $deletedProduct = \App\Models\Product::withTrashed()->find($product->id);
        $this->assertNotNull($deletedProduct->deleted_at); // Verifica se 'deleted_at' não é nulo
    }

    // Teste para restaurar um produto.
    public function testCanRestoreProduct()
    {
        $product = \App\Models\Product::factory()->create();
        $this->delete("/api/products/{$product->id}"); // Soft delete
    
        // Restaura o produto
        $this->post("/api/products/{$product->id}/restore"); // Ajuste conforme sua implementação
    
        // Verifica se o produto foi restaurado
        $restoredProduct = \App\Models\Product::find($product->id);
        $this->assertNotNull($restoredProduct); // O produto deve existir
        $this->assertNull($restoredProduct->deleted_at); // Verifica se 'deleted_at' é nulo
    }
}
