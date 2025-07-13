<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::query()
            ->latest()
            ->paginate(10);

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        // Pass a null client to avoid errors in the view
        return view('clients.create');
    }

    public function store(ClientRequest $request)
    {
        Client::query()->create($request->validated());

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        // Pass the existing client to the form view
        return view('clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client deleted.');
    }

}
