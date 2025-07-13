@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Clients</h2>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">+ New Client</a>
    </div>

    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $clients->links() }}
@endsection
