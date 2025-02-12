@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Service</h2>

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Service Name</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $service->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (₹)</label>
            <input type="number" name="price" class="form-control" value="{{ $service->price }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Service</button>
    </form>
</div>
@endsection
