<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Exports\HoldingsSampleExport;
use Maatwebsite\Excel\Facades\Excel;

class HoldingSampleController extends Controller
{
    public function download()
    {
        return Excel::download(new HoldingsSampleExport, 'holdings_sample.xlsx');
    }
}
