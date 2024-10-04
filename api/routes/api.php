<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Exibir todas as rotas registradas
$router->get('/routes', function () use ($router) {
    return response()->json($router->getRoutes());
});

// Rotas para Clientes
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('clients', ['uses' => 'ClientController@index']); // Listar todos os clientes
    $router->post('clients', ['uses' => 'ClientController@store']); // Criar um novo cliente
    $router->get('clients/{id}', ['uses' => 'ClientController@show']); // Obter um cliente específico
    $router->put('clients/{id}', ['uses' => 'ClientController@update']); // Atualizar um cliente
    $router->delete('clients/{id}', ['uses' => 'ClientController@destroy']); // Deletar um cliente
    $router->post('clients/{id}/restore', ['uses' => 'ClientController@restore']); // Restaurar um cliente
});

// Rotas para Produtos
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('products', ['uses' => 'ProductController@index']); // Listar todos os produtos
    $router->post('products', ['uses' => 'ProductController@store']); // Criar um novo produto
    $router->get('products/{id}', ['uses' => 'ProductController@show']); // Obter um produto específico
    $router->put('products/{id}', ['uses' => 'ProductController@update']); // Atualizar um produto
    $router->delete('products/{id}', ['uses' => 'ProductController@destroy']); // Deletar um produto
    $router->post('products/{id}/restore', ['uses' => 'ProductController@restore']); // Restaurar um produto
});

// Rotas para Pedidos
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('orders', ['uses' => 'OrderController@index']); // Listar todos os pedidos
    $router->post('orders', ['uses' => 'OrderController@store']); // Criar um novo pedido
    $router->get('orders/{id}', ['uses' => 'OrderController@show']); // Obter um pedido específico
    $router->put('orders/{id}', ['uses' => 'OrderController@update']); // Atualizar um pedido
    $router->delete('orders/{id}', ['uses' => 'OrderController@destroy']); // Deletar um pedido
    $router->post('orders/{id}/restore', ['uses' => 'OrderController@restore']); // Restaurar um pedido
});
