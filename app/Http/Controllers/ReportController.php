<?php

namespace App\Http\Controllers;

use App\Exports\SectorWiseReportExport;
use App\Models\Client;
use App\Models\Holding;
use App\Services\Reports\ClientWiseReportService;
use App\Services\Reports\SectorWiseReportService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Exports\ClientWiseReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function clientWise(Request $request, ClientWiseReportService $reportService): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $clients = Client::query()
            ->get(['id', 'name']);

        $sectors = Holding::query()
            ->select('sector')
            ->distinct()
            ->pluck('sector');

        $filters = $request->only(['client_id', 'sector', 'date_from', 'date_to']);
        $report = $reportService->generate($filters);

        return view('reports.client-wise', compact('report', 'clients', 'sectors', 'filters'));
    }

    public function exportClientWisePdf(ClientWiseReportService $reportService)
    {
        $report = $reportService->generate();

        return PDF::loadView('reports.pdf.client-wise', compact('report'))->download('client-wise-report.pdf');
    }

    public function exportClientWiseExcel(ClientWiseReportService $reportService)
    {
        return Excel::download(new ClientWiseReportExport($reportService), 'client-wise-report.xlsx');
    }


    public function sectorWise(SectorWiseReportService $reportService)
    {
        $report = $reportService->generate();

        return view('reports.sector-wise', compact('report'));
    }

    public function exportSectorWisePdf(SectorWiseReportService $reportService)
    {
        $report = $reportService->generate();

        return PDF::loadView('reports.pdf.sector-wise', compact('report'))->download('sector-wise-report.pdf');
    }

    public function exportSectorWiseExcel(SectorWiseReportService $reportService)
    {
        return Excel::download(new SectorWiseReportExport($reportService->generate()), 'sector-wise-report.xlsx');
    }


}
