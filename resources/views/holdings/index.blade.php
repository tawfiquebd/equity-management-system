@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Holdings</h2>

        <a href="{{ route('holdings.create') }}" class="btn btn-success mb-3">+ Add Holding</a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Client</th>
                <th>Stock Code</th>
                <th>Quantity</th>
                <th>Buy Price</th>
                <th>Sector</th>
                <th>Buy Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($holdings as $holding)
                <tr>
                    <td>{{ $holding->client->name ?? '-' }}</td>
                    <td>{{ $holding->stock_code }}</td>
                    <td>{{ $holding->quantity }}</td>
                    <td>{{ number_format($holding->buy_price, 2) }}</td>
                    <td>{{ $holding->sector }}</td>
                    <td>{{ $holding->buy_date ?? '-' }}</td>
                    <td>
                        <a href="{{ route('holdings.edit', $holding) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('holdings.destroy', $holding) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this holding?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">No holdings found.</td></tr>
            @endforelse
            </tbody>
        </table>

        {{ $holdings->links() }}
    </div>
@endsection
