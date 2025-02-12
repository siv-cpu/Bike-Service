@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Bike Services</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add New Service</a>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->description }}</td>
                        <td>₹{{ number_format($service->price, 2) }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>

                          
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@section('styles')
<style>
    .container {
        max-width: 1000px;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #333;
        font-weight: 700;
    }

    .btn {
        font-size: 16px;
    }

    .alert {
        font-size: 14px;
        font-weight: 500;
    }

    .table {
        background-color: #fff;
        border-radius: 8px;
        border-collapse: separate;
    }

    .table th, .table td {
        padding: 12px 15px;
        text-align: center;
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table-bordered {
        border: 1px solid #ddd;
    }

    .table-dark th {
        background-color: #343a40;
        color: white;
    }
</style>
@endsection
@endsection
