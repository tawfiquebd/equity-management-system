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
use App\Exports\ClientWiseReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


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

    public function exportClientWisePdf(Request $request, ClientWiseReportService $reportService)
    {
        $filters = $request->only(['client_id', 'sector', 'date_from', 'date_to']);
        $report = $reportService->generate($filters);

        return PDF::loadView('reports.pdf.client-wise', compact('report'))->download('client-wise-report.pdf');
    }

    public function exportClientWiseExcel(Request $request, ClientWiseReportService $reportService)
    {
        $filters = $request->only(['client_id', 'sector', 'date_from', 'date_to']);

        return Excel::download(new ClientWiseReportExport($reportService, $filters), 'client-wise-report.xlsx');
    }


    public function sectorWise(Request $request, SectorWiseReportService $reportService)
    {
        $filters = $request->only(['sector', 'date_from', 'date_to']);
        $sectors = Holding::query()->select('sector')->distinct()->pluck('sector');
        $report = $reportService->generate($filters);

        return view('reports.sector-wise', compact('report', 'filters', 'sectors'));
    }

    public function exportSectorWisePdf(Request $request, SectorWiseReportService $reportService)
    {
        $filters = $request->only(['sector', 'date_from', 'date_to']);
        $report = $reportService->generate($filters);

        return PDF::loadView('reports.pdf.sector-wise', compact('report'))->download('sector-wise-report.pdf');
    }

    public function exportSectorWiseExcel(Request $request, SectorWiseReportService $reportService)
    {
        $filters = $request->only(['sector', 'date_from', 'date_to']);

        return Excel::download(new SectorWiseReportExport($reportService->generate($filters)), 'sector-wise-report.xlsx');
    }


}
