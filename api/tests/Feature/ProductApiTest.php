<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class ProductApiTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * Teste para listar todos os produtos.
     */
    public function testCanListProducts()
    {
        // Cria alguns produtos
        \App\Models\Product::factory(10)->create();

        // Faz a requisição GET na rota de listagem
        $this->get('/api/products');

        // Verifica o código de status HTTP
        $this->seeStatusCode(200);

        // Verifica se a resposta contém os dados esperados
        $this->seeJsonStructure([
            '*' => [
                'id', 'name', 'price', 'description', 'photo', 'created_at', 'updated_at'
            ]
        ]);
    }

    /**
     * Teste para criar um produto.
     */
    public function testCanCreateProduct()
    {
        $data = [
            'name' => 'Sample Product',
            'price' => 20.99,
            'description' => 'This is a sample product description.',
            'photo' => UploadedFile::fake()->image('product.jpg'), // Gera uma imagem falsa
        ];

        $response = $this->post('/api/products', $data);

        $response->assertResponseStatus(201);
        $this->seeInDatabase('products', ['name' => 'Sample Product']);
    }

    /**
     * Teste para atualizar um produto.
     */
    public function testCanUpdateProduct()
    {
        // Cria um produto
        $product = \App\Models\Product::factory()->create();

        // Dados de exemplo para atualização
        $data = [
            'name' => 'Updated Product',
            'price' => 25.99,
            'description' => 'Updated description.',
        ];

        // Faz a requisição PUT para atualizar o produto
        $this->put("/api/products/{$product->id}", $data);

        // Verifica o código de status HTTP
        $this->seeStatusCode(200);

        // Verifica se os dados retornados foram atualizados corretamente
        $this->seeJson([
            'id' => $product->id,
            'name' => 'Updated Product',
            'price' => '25.99', 
            'description' => 'Updated description.'
        ]);
    }

    /**
     * Teste para deletar um produto.
     */
    public function testCanDeleteProduct()
    {
        // Cria um produto
        $product = \App\Models\Product::factory()->create();

        // Faz a requisição DELETE para remover o produto
        $this->delete("/api/products/{$product->id}");

        // Verifica o código de status HTTP
        $this->seeStatusCode(204);

        // Verifica se o produto foi removido do banco de dados
        $this->notSeeInDatabase('products', ['id' => $product->id]);
    }
}
