@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <h2 class="text-center mb-4">Add New Service</h2>
        <a href="{{ route('services.index') }}" class="btn btn-secondary mb-3">Back</a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="form-label">Service Name</label>
                <input type="text" name="name" class="form-control border-primary" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control border-primary" rows="4"></textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">Price (₹)</label>
                <input type="number" name="price" class="form-control border-primary" required>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">Save Service</button>
        </form>
    </div>
</div>

@section('styles')
<style>
    .container {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .col-lg-6 {
        max-width: 600px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .btn {
        font-size: 16px;
    }

    .alert {
        font-size: 14px;
        font-weight: 500;
    }

    .btn-secondary {
        font-size: 16px;
    }
</style>
@endsection

@endsection
