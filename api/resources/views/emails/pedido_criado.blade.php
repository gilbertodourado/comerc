<!DOCTYPE html>
<html>
<head>
    <title>Pedido Criado</title>
</head>
<body>
    <h1>Seu pedido foi criado com sucesso!</h1>
    <p>Detalhes do pedido:</p>
    <ul>
        <li>ID do Pedido: {{ $pedido->id }}</li>
        <li>ID do Cliente: {{ $pedido->client_id }}</li>
        <li>Produtos: 
            @foreach ($pedido->products as $product)
                <li>{{ $product->name }}</li>
            @endforeach
        </li>
    </ul>
</body>
</html>
