<?php

namespace App\Http\Controllers\Api;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ClientApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Client::query()
                ->latest()->paginate(10),
        ]);
    }

    public function store(ClientRequest $request)
    {
        $client = Client::query()
            ->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Client created successfully',
            'data' => $client,
        ], ResponseAlias::HTTP_CREATED);
    }

    public function show(Client $client)
    {
        return response()->json([
            'success' => true,
            'data' => $client,
        ], ResponseAlias::HTTP_OK);
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Client updated successfully',
            'data' => $client,
        ], ResponseAlias::HTTP_OK);
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'success' => true,
            'message' => 'Client deleted successfully',
        ], ResponseAlias::HTTP_OK);
    }
}

