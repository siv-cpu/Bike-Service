@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Booking Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Customer Name: {{ $booking->user->name }}</h5>
            <p><strong>Service:</strong> {{ $booking->service->name }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ $booking->status === 'completed' ? 'success' : ($booking->status === 'ready_for_delivery' ? 'warning' : 'secondary') }}">
                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                </span>
            </p>
            <p><strong>Booking Date:</strong> {{ $booking->date }}</p>
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
        </div>
    </div>
</div>
@endsection
