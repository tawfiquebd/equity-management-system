<?php

namespace App\Exports;

use App\Services\Reports\ClientWiseReportService;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromArray;

class ClientWiseReportExport implements FromArray
{
    protected ClientWiseReportService $reportService;
    private $filters;

    public function __construct(ClientWiseReportService $reportService, $filters)
    {
        $this->reportService = $reportService;
        $this->filters = $filters;
    }

    public function array(): array
    {
        return $this->reportService->generate($this->filters)->toArray();
    }
}
