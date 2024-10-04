<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{
    public function createClient($data)
    {
        return Client::create($data);
    }

    public function updateClient($id, $data)
    {
        $client = Client::findOrFail($id);
        $client->update($data);
        return $client;
    }

    public function deleteClient($id)
    {
        $client = Client::findOrFail($id);
        $client->delete(); // Usa soft delete
    }

    public function restoreClient($id)
    {
        $client = Client::withTrashed()->find($id);

        if ($client) {
            $client->restore(); // Restaura o cliente
            return $client;
        }

        throw new \Exception("Client not found.");
    }

    public function forceDeleteClient($id)
    {
        $client = Client::withTrashed()->find($id);

        if ($client) {
            $client->forceDelete(); // Exclui permanentemente
        } else {
            throw new \Exception("Client not found.");
        }
    }

    public function getClient($id)
    {
        return Client::withTrashed()->findOrFail($id); // Retorna mesmo se estiver "deletado"
    }

    public function getAllClients()
    {
        return Client::all(); // Retorna apenas os ativos
    }

    public function getAllClientsWithTrashed()
    {
        return Client::withTrashed()->get(); // Retorna todos, incluindo "deletados"
    }
}
