<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class HoldingsSampleExport implements FromArray
{
    public function array(): array
    {
        return [
            ['client_id', 'stock_code', 'quantity', 'buy_price', 'sector', 'buy_date'],
            [1, 'ACI', 100, 45.50, 'Pharma', '2025-07-14'],
            [2, 'BXPHARMA', 50, 65.00, 'Pharma', '2025-07-13'],
        ];
    }
}

