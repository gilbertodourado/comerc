<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        // Validação dos dados de entrada
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Criação do pedido usando 'client_id', 'product_ids' e 'quantities'
        $order = $this->orderService->createOrder($request->client_id, $request->product_ids, $request->quantities);
    
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
