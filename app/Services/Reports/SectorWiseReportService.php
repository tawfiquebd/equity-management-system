<?php

namespace App\Services\Reports;

use App\Models\Client;
use App\Models\Holding;
use Illuminate\Support\Collection;

class SectorWiseReportService
{
    public function generate(array $filters = []): Collection
    {
        return Holding::query()
            ->when(
                !empty($filters['sector']), fn($q) => $q->where('sector', $filters['sector'])
            )
            ->when(
                !empty($filters['date_from']), fn($q) => $q->whereDate('buy_date', '>=', $filters['date_from'])
            )
            ->when(
                !empty($filters['date_to']), fn($q) => $q->whereDate('buy_date', '<=', $filters['date_to'])
            )
            ->select('sector')
            ->selectRaw('SUM(quantity * buy_price) as total_investment')
            ->selectRaw('COUNT(*) as total_holdings')
            ->groupBy('sector')
            ->orderBy('sector')
            ->get();
    }
}
