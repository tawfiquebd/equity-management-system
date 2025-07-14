<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Holding;
use App\Http\Requests\HoldingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HoldingApiController extends Controller
{
    public function index(): JsonResponse
    {
        $holdings = Holding::query()
            ->with('client')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $holdings
        ], ResponseAlias::HTTP_OK);
    }

    public function store(HoldingRequest $request): JsonResponse
    {
        $holding = Holding::query()
            ->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Holding created successfully',
            'data' => $holding
        ], ResponseAlias::HTTP_OK);
    }

    public function show(Holding $holding): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $holding->load('client')
        ], ResponseAlias::HTTP_OK);
    }

    public function update(HoldingRequest $request, Holding $holding): JsonResponse
    {
        $holding->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Holding updated successfully',
            'data' => $holding
        ], ResponseAlias::HTTP_OK);
    }

    public function destroy(Holding $holding): JsonResponse
    {
        $holding->delete();

        return response()->json([
            'success' => true,
            'message' => 'Holding deleted successfully'
        ], ResponseAlias::HTTP_OK);
    }
}

