<?php

namespace App\Jobs;

use App\Models\Holding;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateHoldingPricesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }


    public function handle(): void
    {
        $response = Http::withToken(env('JWT_TOKEN'))->get(config('app.url') . '/api/mock-stock-prices');

        if ($response->ok()) {
            $stocks = json_decode($response->body(), true)['data'] ?? [];

            Holding::query()->chunk(100, function ($holdings) use ($stocks) {
                foreach ($holdings as $holding) {
                    if (isset($stocks[$holding->stock_code])) {
                        $holding->update([
                            'current_price' => $stocks[$holding->stock_code]
                        ]);
                    }
                }
            });
        } else {
            logger()->error('Failed to fetch stock prices', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }
    }
}
