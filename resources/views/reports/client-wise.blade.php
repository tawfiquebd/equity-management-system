@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Client-wise Equity Summary</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Client</th>
                <th>Total Investment</th>
                <th>Total Holdings</th>
            </tr>
            </thead>
            <tbody>
            @foreach($report as $row)
                <tr>
                    <td>{{ $row['client'] }}</td>
                    <td>{{ number_format($row['total_investment'], 2) }}</td>
                    <td>{{ $row['total_holdings'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
