@extends('layouts.app')

@section('content')
    <div class="group" style="float: right;">
        <a href="{{ route('reports.client-wise.pdf', request()->only(['client_id', 'sector', 'date_from', 'date_to'])) }}" class="btn btn-sm btn-danger mb-3">Export as PDF</a>
        <a href="{{ route('reports.client-wise.excel', request()->only(['client_id', 'sector', 'date_from', 'date_to'])) }}" class="btn btn-sm btn-success mb-3">Export as Excel</a>
    </div>
    <div class="container">
        <h4>Client-wise Equity Summary</h4>

        {{-- Filter Form Starts Here --}}
        <form method="GET" class="row mb-4">
            <div class="col-md-3">
                <label>Client</label>
                <select name="client_id" class="form-control">
                    <option value="">All</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Sector</label>
                <select name="sector" class="form-control">
                    <option value="">All</option>
                    @foreach($sectors as $sector)
                        <option value="{{ $sector }}" {{ request('sector') == $sector ? 'selected' : '' }}>
                            {{ $sector }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Date From</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-3">
                <label>Date To</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-12 mt-2">
                <button class="btn btn-primary">Search</button>
                <a href="{{ route('reports.client-wise') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        {{-- Filter Form Ends Here --}}


        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Client</th>
                <th>Sector</th>
                <th>Total Investment</th>
                <th>Total Holdings</th>
            </tr>
            </thead>
            <tbody>
            @foreach($report as $row)
                <tr>
                    <td>{{ $row['client'] }}</td>
                    <td>{{ $row['sector'] }}</td>
                    <td>{{ number_format($row['total_investment'], 2) }}</td>
                    <td>{{ $row['total_holdings'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
