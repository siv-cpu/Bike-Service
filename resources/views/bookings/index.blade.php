@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">All Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->service->name }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status === 'completed' ? 'success' : ($booking->status === 'ready_for_delivery' ? 'warning' : 'secondary') }}">
                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                            </span>
                        </td>
                        <td>{{ $booking->date }}</td>
                        <td>
                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>

                            @if($booking->status === 'pending')
                                <form action="{{ route('bookings.ready', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Ready for Delivery</button>
                                </form>
                            @endif

                            @if($booking->status === 'ready_for_delivery')
                                <form action="{{ route('bookings.completed', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
