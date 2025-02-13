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
        $bookings = Booking::all(); //retrive all Booking
        return view('bookings.index', compact('bookings')); //pass data to view
    }

    
    public function show($id)
    {
        $booking = Booking::with(['user', 'service'])->findOrFail($id); // Fetch booking with user and  service
        return view('bookings.show', compact('booking')); // Pass the data view
    }

    
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->with('service')->get(); // Get only current user
        return view('bookings.my_bookings', compact('bookings'));
    }

    
    public function create()
    {
        $services = Service::all();  // Fetch all available service
        return view('bookings.create', compact('services'));// Pass services to view
    }

    public function store(Request $request)
    {
        //validation
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after:today',
        ]);
//store datas
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'date' => $request->date,
            'status' => 'pending',
        ]);

        //new booking mail notifiaction
        Mail::to('ajsiva088@gmail.com')->send(new NewBookingNotification($booking));

        return redirect()->route('bookings.my_bookings')->with('success', 'Your booking has been created!');
    }

   //for booking ready
    public function markAsReady($id)
    {
        $booking = Booking::findOrFail($id); // Find booking by ID
        $booking->status = 'ready_for_delivery'; // Update status    
        $booking->save();

        // booking being ready
        Mail::to($booking->user->email)->send(new NewBookingNotification($booking));

        return redirect()->route('bookings.index')->with('success', 'Booking marked as Ready for Delivery.');
    }

    //for complete
    public function markAsCompleted($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('bookings.index')->with('success', 'Booking marked as Completed.');
    }
}
