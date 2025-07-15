<?php

namespace App\Services\Reports;

use App\Models\Client;
use Illuminate\Support\Collection;

class ClientWiseReportService
{
    public function generate(array $filters = []): Collection
    {
        return Client::query()
            ->with('holdings')
            ->when($filters['client_id'] ?? null, fn($q, $clientId) => $q->where('id', $clientId))
                ->with(['holdings' => function ($q) use ($filters) {
                    $q->when($filters['sector'] ?? null, fn($q, $sector) => $q->where('sector', $sector))
                        ->when($filters['date_from'] ?? null, fn($q, $from) => $q->whereDate('buy_date', '>=', $from))
                        ->when($filters['date_to'] ?? null, fn($q, $to) => $q->whereDate('buy_date', '<=', $to));
                }])
            ->get()
            ->map(function ($client) {
                $totalInvestment = $client->holdings->sum(fn($h) => $h->quantity * $h->buy_price);

                return [
                    'client' => $client->name,
                    'total_investment' => $totalInvestment,
                    'total_holdings' => $client->holdings->count(),
                ];
            });
    }
}
