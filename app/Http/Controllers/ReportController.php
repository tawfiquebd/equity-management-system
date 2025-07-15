<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function clientWise(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $clients = Client::query()
            ->with('holdings')
            ->get();

        $report = $clients->map(function ($client) {
            $totalInvestment = $client->holdings->sum(function ($h) {
                return $h->quantity * $h->buy_price;
            });

            return [
                'client' => $client->name,
                'total_investment' => $totalInvestment,
                'total_holdings' => $client->holdings->count(),
            ];
        });

        return view('reports.client-wise', compact('report'));
    }

}
