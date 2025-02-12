@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #4A90E2, #145DA0);
        color: #5c5959;
    }
    .dashboard-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
    }
    .dashboard-card {
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        max-width: 500px;
    }
    .dashboard-card h3 {
        font-weight: bold;
    }
    .dashboard-card h2 {
        font-size: 28px;
        margin-bottom: 15px;
    }
    .dashboard-card p {
        font-size: 16px;
        opacity: 0.9;
    }
    .btn-custom {
        background: #ffcc00;
        color: #333;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 8px;
        transition: 0.3s;
    }
    .btn-custom:hover {
        background: #ffdb4d;
        color: #000;
    }
</style>

<div class="container dashboard-container">
    <div class="dashboard-card">
        <h3>Welcome, {{ auth()->user()->name }}!</h3>
        @if(auth()->user()->role == 'admin')
            <h2>Bike Service Owner</h2>
            <p>Manage services and customer bookings efficiently.</p>
            <a href="{{ route('services.index') }}" class="btn btn-custom">Manage Services</a>
            <a href="{{ route('bookings.index') }}" class="btn btn-custom">customer bookings </a>
        @else
            <h2>Dear Customer</h2>
            <p>Book a service and track your bike's service status with ease.</p>
            <a href="{{ route('bookings.my_bookings') }}" class="btn btn-custom">Book a Service</a>
        @endif
    </div>
</div>
@endsection
