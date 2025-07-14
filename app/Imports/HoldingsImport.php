<?php

namespace App\Imports;

use App\Models\Holding;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HoldingsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Holding([
            'client_id'     => $row['client_id'],
            'stock_code'  => $row['stock_code'],
            'quantity'      => $row['quantity'],
            'buy_price'     => $row['buy_price'],
            'sector'        => $row['sector'],
            'buy_date'      => $row['buy_date'] ?? null,
        ]);
    }
}
