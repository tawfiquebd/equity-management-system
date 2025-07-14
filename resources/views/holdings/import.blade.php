@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('holdings.sample.download') }}" class="btn btn-secondary mb-3">
            Download Sample Excel Template
        </a>

        <h4>Import Holdings from Excel</h4>
        <form action="{{ route('holdings.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="excel_file" required class="form-control my-2">
            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
@endsection
