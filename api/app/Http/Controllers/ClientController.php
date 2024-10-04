<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Adicione esta linha
use App\Services\ClientService;

class ClientController extends Controller
{
    protected ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    // Listar todos os clientes
    public function index()
    {
        $clients = $this->clientService->getAllClients();
        return response()->json($clients);
    }

    // Armazenar um novo cliente
    public function store(Request $request) // Alterado para Request
    {
        // Coletar os dados do cliente
        $clientData = $request->all(); // Coleta todos os dados sem validação
        $client = $this->clientService->createClient($clientData);
        return response()->json($client, 201);
    }

    // Mostrar um cliente específico
    public function show($id)
    {
        $client = $this->clientService->getClientById($id);
        return response()->json($client);
    }

    // Atualizar um cliente existente
    public function update(Request $request, $id) // Alterado para Request
    {
        // Coletar os dados do cliente
        $clientData = $request->all(); // Coleta todos os dados sem validação
        $client = $this->clientService->updateClient($id, $clientData);
        return response()->json($client);
    }

    // Deletar um cliente
    public function destroy($id)
    {
        $this->clientService->deleteClient($id);
        return response()->json(null, 204);
    }

    // Restaurar um cliente excluído
    public function restore($id)
    {
        $this->clientService->restoreClient($id);
        return response()->json(null, 204);
    }

    // Deletar um cliente permanentemente
    public function forceDelete($id)
    {
        $this->clientService->forceDeleteClient($id);
        return response()->json(null, 204);
    }
}
