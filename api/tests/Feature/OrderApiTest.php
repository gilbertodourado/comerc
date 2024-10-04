<?php

namespace Tests\Feature;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Teste para listar todos os pedidos.
     */
    public function testCanListOrders()
    {
        \App\Models\Order::factory(10)->create();

        $response = $this->get('/api/orders');

        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            '*' => [
                'id', 'client_id', 'created_at', 'updated_at', 'deleted_at'
            ]
        ]);
    }

    /**
     * Teste para criar um pedido.
     */
    public function testCanCreateOrder()
    {
        \App\Models\Product::factory()->create(['id' => 1]);
        \App\Models\Product::factory()->create(['id' => 2]);
        \App\Models\Client::factory()->create(['id' => 1]);

        $response = $this->post('/api/orders', [
            'product_ids' => [1, 2],
            'client_id' => 1,
            'quantities' => [2, 3],
        ]);

        $response->assertResponseStatus(201);

        // Verifique se o pedido foi criado corretamente
        $this->seeInDatabase('orders', [
            'client_id' => 1,
            // Ajuste aqui se necessário
        ]);
    }

    /**
     * Teste para atualizar um pedido.
     */
    public function testCanUpdateOrder()
    {
        $order = \App\Models\Order::factory()->create();

        $data = [
            'client_id' => \App\Models\Client::factory()->create()->id,
        ];

        $response = $this->put("/api/orders/{$order->id}", $data);

        $response->assertResponseStatus(200);
        $response->seeJson([
            'id' => $order->id,
            'client_id' => $data['client_id'],
        ]);
    }

    /**
     * Teste para deletar um pedido.
     */
    public function testCanDeleteOrder()
    {
        $order = \App\Models\Order::factory()->create();

        $response = $this->delete("/api/orders/{$order->id}");

        $response->assertResponseStatus(204);
        $this->notSeeInDatabase('orders', ['id' => $order->id]);
    }
}
