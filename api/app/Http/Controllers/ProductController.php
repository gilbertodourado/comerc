<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        // Pega todos os dados da requisição
        $productData = $request->all(); 
        $product = $this->productService->createProduct($productData);
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->productService->getProduct($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        // Pega todos os dados da requisição
        $productData = $request->all(); 
        $product = $this->productService->updateProduct($id, $productData);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(null, 204);
    }

    public function restore($id)
    {
        $this->productService->restoreProduct($id);
        return response()->json(null, 204);
    }

    public function forceDelete($id)
    {
        $this->productService->forceDeleteProduct($id);
        return response()->json(null, 204);
    }
}
