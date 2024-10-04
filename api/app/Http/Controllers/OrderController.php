<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        // Criação do pedido usando 'customer_id' e 'product_ids'
        $order = $this->orderService->createOrder($request->customer_id, $request->product_ids);

        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrder($id);

        return response()->json($order);
    }

    public function index()
    {
        $orders = $this->orderService->getAllOrders();

        return response()->json($orders);
    }

    public function update(Request $request, $id)
    {
        $order = $this->orderService->updateOrder($id, $request->all());

        return response()->json($order);
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);

        return response()->json(null, 204);
    }

    public function restore($id)
    {
        $order = $this->orderService->restoreOrder($id); // Método para restaurar

        return response()->json($order);
    }
}
