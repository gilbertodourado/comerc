<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Client; // Certifique-se de importar o modelo correto
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderService
{
    public function createOrder($clientId, $productIds, $quantities)
    {
        // Verificar se o cliente existe
        $client = Client::find($clientId);
        
        if (!$client) {
            throw new ModelNotFoundException("Client not found");
        }

        // Criar o pedido
        $order = Order::create(['client_id' => $clientId]);
        
        // Adicionar produtos ao pedido com as respectivas quantidades
        foreach ($productIds as $index => $productId) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $quantities[$index], // Adicionando a quantidade
            ]);
        }

        return $order->load('products');
    }

    public function updateOrder($id, $data)
    {
        $order = Order::findOrFail($id);
        $order->update($data);

        if (isset($data['product_ids'])) {
            // Atualiza os produtos relacionados ao pedido
            $order->products()->sync($data['product_ids']);
        }

        return $order->load('products');
    }

    public function getOrder($id)
    {
        return Order::with('products')->findOrFail($id);
    }

    public function getAllOrders()
    {
        return Order::with('products')->get();
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->forceDelete(); // Isso agora usará soft deletes
    }
}
