<?php

namespace App\Http\Controllers;

use App\Imports\HoldingsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HoldingImportController extends Controller
{
    public function showForm()
    {
        return view('holdings.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new HoldingsImport, $request->file('excel_file'));

        return redirect()->back()->with('success', 'File imported successfully.');
    }
}
