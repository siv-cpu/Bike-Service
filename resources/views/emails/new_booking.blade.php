<!DOCTYPE html>
<html>
<head>
    <title>New Booking Notification</title>
</head>
<body>
    <h2>New Booking Received</h2>
    <p><strong>Customer Name:</strong> {{ $booking->user->name }}</p>
    <p><strong>Service:</strong> {{ $booking->service->name }}</p>
    <p><strong>Date:</strong> {{ $booking->date }}</p>
    <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $booking->status)) }}</p>
    <p>Check your admin panel for more details.</p>
</body>
</html>
