<?php

namespace App\Exports;

use App\Services\Reports\ClientWiseReportService;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromArray;

class ClientWiseReportExport implements FromArray
{
    protected ClientWiseReportService $reportService;

    public function __construct(ClientWiseReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function array(): array
    {
        return $this->reportService->generate()->toArray();
    }
}
