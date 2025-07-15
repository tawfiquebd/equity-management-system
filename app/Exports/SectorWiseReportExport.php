<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class SectorWiseReportExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($row) {
            return [
                $row->sector,
                $row->total_investment,
                $row->total_holdings,
            ];
        });
    }

    public function headings(): array
    {
        return ['Sector', 'Total Investment', 'Total Holdings'];
    }
}
