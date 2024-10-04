<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Exibir todas as rotas registradas (remova em produção)
$router->get('/routes', function () use ($router) {
    return response()->json($router->getRoutes());
});

// Rotas para Clientes
$router->group(['prefix' => 'api/clients'], function () use ($router) {
    $router->get('/', 'ClientController@index'); // Listar todos os clientes
    $router->post('/', 'ClientController@store'); // Criar um novo cliente
    $router->get('{id}', 'ClientController@show'); // Obter um cliente específico
    $router->put('{id}', 'ClientController@update'); // Atualizar um cliente
    $router->delete('{id}', 'ClientController@destroy'); // Deletar um cliente
    $router->post('{id}/restore', 'ClientController@restore'); // Restaurar um cliente
});

// Rotas para Produtos
$router->group(['prefix' => 'api/products'], function () use ($router) {
    $router->get('/', 'ProductController@index'); // Listar todos os produtos
    $router->post('/', 'ProductController@store'); // Criar um novo produto
    $router->get('{id}', 'ProductController@show'); // Obter um produto específico
    $router->put('{id}', 'ProductController@update'); // Atualizar um produto
    $router->delete('{id}', 'ProductController@destroy'); // Deletar um produto
    $router->post('{id}/restore', 'ProductController@restore'); // Restaurar um produto
});

// Rotas para Pedidos
$router->group(['prefix' => 'api/orders'], function () use ($router) {
    $router->get('/', 'OrderController@index'); // Listar todos os pedidos
    $router->post('/', 'OrderController@store'); // Criar um novo pedido
    $router->get('{id}', 'OrderController@show'); // Obter um pedido específico
    $router->put('{id}', 'OrderController@update'); // Atualizar um pedido
    $router->delete('{id}', 'OrderController@destroy'); // Deletar um pedido
    $router->post('{id}/restore', 'OrderController@restore'); // Restaurar um pedido
});
