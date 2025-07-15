<?php

namespace App\Services\Reports;

use App\Models\Client;
use App\Models\Holding;
use Illuminate\Support\Collection;

class SectorWiseReportService
{
    public function generate(): Collection
    {
        return Holding::query()
            ->select('sector')
            ->selectRaw('SUM(quantity * buy_price) as total_investment')
            ->selectRaw('COUNT(*) as total_holdings')
            ->groupBy('sector')
            ->orderBy('sector')
            ->get();
    }
}
