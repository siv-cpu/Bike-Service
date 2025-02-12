@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Book a Bike Service</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="service_id" class="form-label">Select Service</label>
            <select class="form-select" id="service_id" name="service_id" required>
                <option value="" disabled selected>Select a Service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Select Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>
@endsection
