@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Sector-wise Equity Summary</h4>

        <a href="{{ route('reports.sector-wise.pdf') }}" class="btn btn-danger mb-3">Export as PDF</a>
        <a href="{{ route('reports.sector-wise.excel') }}" class="btn btn-success mb-3">Export as Excel</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Sector</th>
                <th>Total Investment</th>
                <th>Total Holdings</th>
            </tr>
            </thead>
            <tbody>
            @forelse($report as $row)
                <tr>
                    <td>{{ $row->sector }}</td>
                    <td>{{ number_format($row->total_investment, 2) }}</td>
                    <td>{{ $row->total_holdings }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No data available.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
