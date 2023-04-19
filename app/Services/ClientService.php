<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientService
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Gets all clients
     *
     * @return Collection
     */
    public function getClients(): Collection
    {
        return $this->client->get();
    }

    /**
     * Creates client
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phoneNumber
     * @return Client
     */
    public function createClient(
        string $firstName,
        string $lastName,
        string $email,
        string $phoneNumber
    ): Client
    {
        return $this->client->create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone_number' => $phoneNumber
        ]);
    }

    /**
     * Gets client by id
     *
     * @param integer $id
     * @return Client
     */
    public function getClientById(int $id): Client
    {
        return $this->client->find($id);
    }

    /**
     * Updates client
     *
     * @param integer $id
     * @param array $updates
     * @return Client
     */
    public function updateClient(int $id, array $updates): Client
    {
        $client = $this->getClientById($id);
        $client->update($updates);
        return $client->refresh();
    }
}