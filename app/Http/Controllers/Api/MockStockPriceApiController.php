<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MockStockPriceApiController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $json = Storage::disk()->get('mock/stock_prices.json');
            $data = json_decode($json, true);

            return response()->json([
                'message' => 'Data fetched successfully!',
                'success' => true,
                'code' => ResponseAlias::HTTP_OK,
                'data' => $data ?? [],
            ], ResponseAlias::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong! '.$e->getMessage(),
                'success' => true,
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'data' => [],
            ], $e->getCode());
        }

    }
}
