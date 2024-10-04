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
$router->group(['prefix' => 'api/clients'], function () use ($router) {
    $router->get('/', ['uses' => 'ClientController@index']); // Listar todos os clientes
    $router->post('/', ['uses' => 'ClientController@store']); // Criar um novo cliente
    $router->get('{id}', ['uses' => 'ClientController@show']); // Obter um cliente específico
    $router->put('{id}', ['uses' => 'ClientController@update']); // Atualizar um cliente
    $router->delete('{id}', ['uses' => 'ClientController@destroy']); // Deletar um cliente
    $router->post('{id}/restore', ['uses' => 'ClientController@restore']); // Restaurar um cliente
});

// Rotas para Produtos
$router->group(['prefix' => 'api/products'], function () use ($router) {
    $router->get('/', ['uses' => 'ProductController@index']); // Listar todos os produtos
    $router->post('/', ['uses' => 'ProductController@store']); // Criar um novo produto
    $router->get('{id}', ['uses' => 'ProductController@show']); // Obter um produto específico
    $router->put('{id}', ['uses' => 'ProductController@update']); // Atualizar um produto
    $router->delete('{id}', ['uses' => 'ProductController@destroy']); // Deletar um produto
    $router->post('{id}/restore', ['uses' => 'ProductController@restore']); // Restaurar um produto
});

// Rotas para Pedidos
$router->group(['prefix' => 'api/orders'], function () use ($router) {
    $router->get('/', ['uses' => 'OrderController@index']); // Listar todos os pedidos
    $router->post('/', ['uses' => 'OrderController@store']); // Criar um novo pedido
    $router->get('{id}', ['uses' => 'OrderController@show']); // Obter um pedido específico
    $router->put('{id}', ['uses' => 'OrderController@update']); // Atualizar um pedido
    $router->delete('{id}', ['uses' => 'OrderController@destroy']); // Deletar um pedido
    $router->post('{id}/restore', ['uses' => 'OrderController@restore']); // Restaurar um pedido
});
