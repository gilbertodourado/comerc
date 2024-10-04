<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ClientApiTest extends TestCase
{
    use DatabaseMigrations; // Para garantir que o banco de dados seja migrado a cada teste
    use DatabaseTransactions; // Cada teste será revertido automaticamente

    /**
     * Teste para listar todos os clientes.
     */
    public function testCanListClients()
    {
        // Cria alguns clientes
        \App\Models\Client::factory(10)->create();

        // Faz a requisição GET na rota de listagem
        $this->get('/api/clients');

        // Verifica o código de status HTTP
        $this->seeStatusCode(200);

        // Verifica se a resposta contém os dados esperados
        $this->seeJsonStructure([
            '*' => [
                'id', 'name', 'email', 'created_at', 'updated_at'
            ]
        ]);
    }

    /**
     * Teste para criar um cliente.
     */
    public function testCanCreateClient()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '123456789',
            'birth_date' => '1990-01-01',
            'address' => '123 Main St',
            'complement' => 'Apt 4',
            'neighborhood' => 'Downtown',
            'zip_code' => '12345',
        ];

        $response = $this->post('/api/clients', $data);

        $response->assertResponseStatus(201);
        $this->seeInDatabase('clients', ['email' => 'john@example.com']);
    }

    /**
     * Teste para atualizar um cliente.
     */
    public function testCanUpdateClient()
    {
        // Cria um cliente
        $client = \App\Models\Client::factory()->create();

        // Dados de exemplo para atualização
        $data = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ];

        // Faz a requisição PUT para atualizar o cliente
        $this->put("/api/clients/{$client->id}", $data);

        // Verifica o código de status HTTP
        $this->seeStatusCode(200);

        // Verifica se os dados retornados foram atualizados corretamente
        $this->seeJson([
            'id' => $client->id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com'
        ]);
    }

    /**
     * Teste para deletar um cliente (soft delete).
     */
    public function testCanSoftDeleteClient()
    {
        // Cria um cliente
        $client = \App\Models\Client::factory()->create();

        // Faz a requisição DELETE para remover o cliente
        $this->delete("/api/clients/{$client->id}");

        // Verifica o código de status HTTP
        $this->seeStatusCode(204);

        // Verifica se o cliente ainda existe na tabela e se 'deleted_at' não é nulo
        $this->seeInDatabase('clients', [
            'id' => $client->id,
            'deleted_at' => $client->fresh()->deleted_at // confirma que o cliente está "deletado"
        ]);
    }

    /**
     * Teste para restaurar um cliente deletado (soft delete).
     */
    public function testCanRestoreClient()
    {
        // Cria um cliente e o deleta (soft delete)
        $client = \App\Models\Client::factory()->create();
        $this->delete("/api/clients/{$client->id}");

        // Restaura o cliente
        $this->post("/api/clients/{$client->id}/restore");

        // Verifica o código de status HTTP
        $this->seeStatusCode(204);

        // Verifica se o cliente foi restaurado
        $this->seeInDatabase('clients', [
            'id' => $client->id,
            'deleted_at' => null // deve ser null após a restauração
        ]);
    }
}
