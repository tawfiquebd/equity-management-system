@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Holding</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('holdings.update', $holding) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Client</label>
                <select name="client_id" class="form-control" required>
                    <option value="">-- Select Client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ $holding->client_id == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock Code</label>
                <input type="text" name="stock_code" class="form-control" value="{{ old('stock_code', $holding->stock_code) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $holding->quantity) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Buy Price</label>
                <input type="number" step="0.01" name="buy_price" class="form-control" value="{{ old('buy_price', $holding->buy_price) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sector</label>
                <input type="text" name="sector" class="form-control" value="{{ old('sector', $holding->sector) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Buy Date</label>
                <input type="date" name="buy_date" class="form-control" value="{{ old('buy_date', $holding->buy_date) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
