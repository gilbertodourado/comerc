<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function createProduct($data)
    {
        // Verifica se há upload de imagem e salva no storage
        if (isset($data['photo'])) {
            $data['photo'] = $this->storePhoto($data['photo']);
        }

        return Product::create($data);
    }

    public function updateProduct($id, $data)
    {
        $product = Product::findOrFail($id);

        // Verifica se há upload de nova imagem e substitui
        if (isset($data['photo'])) {
            $this->deletePhoto($product->photo); // Exclui a imagem anterior
            $data['photo'] = $this->storePhoto($data['photo']);
        }

        $product->update($data);
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->deletePhoto($product->photo); // Exclui a imagem
        $product->delete();
    }

    public function getProduct($id)
    {
        return Product::findOrFail($id);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    private function storePhoto($photo)
    {
        return Storage::disk('public')->put('products', $photo); // Salva a foto na pasta 'products'
    }

    private function deletePhoto($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path); // Exclui a imagem anterior
        }
    }
    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->find($id);

        if ($product) {
            $product->restore();
            return $product;
        }

        throw new \Exception("Product not found.");
    }
}
