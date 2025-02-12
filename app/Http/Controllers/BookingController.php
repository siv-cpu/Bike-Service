<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use App\Mail\NewBookingNotification;
use App\Mail\BookingReadyNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    
    public function show($id)
    {
        $booking = Booking::with(['user', 'service'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('service')->get();
        return view('bookings.my_bookings', compact('bookings'));
    }

    
    public function create()
    {
        $services = Service::all();
        return view('bookings.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after:today',
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'date' => $request->date,
            'status' => 'pending',
        ]);

        
        Mail::to('ajsiva088@gmail.com')->send(new NewBookingNotification($booking));

        return redirect()->route('bookings.my_bookings')->with('success', 'Your booking has been created!');
    }

   
    public function markAsReady($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'ready_for_delivery';
        $booking->save();

        
        Mail::to($booking->user->email)->send(new NewBookingNotification($booking));

        return redirect()->route('bookings.index')->with('success', 'Booking marked as Ready for Delivery.');
    }

    
    public function markAsCompleted($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking marked as Completed.');
    }
}
