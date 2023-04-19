<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    private ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function getClients()
    {
        return view('clients', ['clients' => $this->clientService->getClients()]);
    }

    public function createClient(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:clients,email',
            'phone_number' => 'required|max_digits:11',
        ]);

        if ($validator->fails()) {
            return redirect('addClient')
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->clientService->createClient(
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->phone_number
        );

        return redirect('clients');
    }

    public function editClient(int $clientId)
    {
        return view('editClient', ['client' => $this->clientService->getClientById($clientId)]);
    }

    public function updateClient(Request $request, int $clientId)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:clients,email',
            'phone_number' => 'required|max_digits:11',
        ]);

        if ($validator->fails()) {
            return redirect('editClient')
                        ->withErrors($validator)
                        ->withInput();
        }

        $this->clientService->updateClient(
            $clientId,
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number
            ]
        );

        return redirect('clients');
    }
}