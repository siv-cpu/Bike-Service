@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4">My Bookings</h2>
    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3 mt-4">New Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Service</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>
                        <span class="badge bg-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'ready_for_delivery' ? 'primary' : 'success') }}">
                            {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
