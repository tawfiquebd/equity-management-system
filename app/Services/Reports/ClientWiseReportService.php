<?php

namespace App\Services\Reports;

use App\Models\Client;
use Illuminate\Support\Collection;

class ClientWiseReportService
{
    public function generate(array $filters = [])
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
                $currentValue = $client->holdings->sum(fn($h) => $h->quantity * $h->current_price);
                $gainLoss = $currentValue - $totalInvestment;
                $gainLossPercent = $totalInvestment > 0 ? round(($gainLoss / $totalInvestment) * 100, 2) : 0;

                return $client->holdings->map(function ($holding) use ($client, $totalInvestment, $currentValue) {
                    return [
                        'client_name' => $client->name,
                        'client_email' => $client->email,
                        'client_phone' => $client->phone,
                        'sector' => $holding->sector ?? '',
                        'total_investment' => round($totalInvestment, 2),
                        'current_value' => round($currentValue, 2),
                        'total_holdings' => $client->holdings->count(),
                    ];
                });

            })->flatten(1);
    }
}
