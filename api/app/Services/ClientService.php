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
        $client->forceDelete();
    }

    public function getClient($id)
    {
        return Client::findOrFail($id);
    }

    public function getAllClients()
    {
        return Client::all();
    }
}
