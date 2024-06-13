<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Movie;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBookingPage($id)
    {
        $movie = Movie::findOrFail($id); // Assuming Movie model exists

        return view('movies.book', compact('movie'));
    }

    public function reserveSeat(Request $request)
{
    $request->validate([
        'movie_id' => 'required|exists:movies,id',
        'poster' => 'required|string',
        'movie_title' => 'required|string',
        'seatArrangement' => 'required|string',
        'quantity' => 'required|integer|min:1', // Ensure at least one seat is booked
    ]);

    $totalAmount = $request->quantity * 150; // Assuming ticket price is 150 pesos

    // Generate a unique booking ID (you may have your own logic for this)
    $bookingId = uniqid();

    // Save booking details to session for later confirmation
    session([
        'booking' => [
            'id' => $bookingId, // Unique booking ID
            'user_id' => auth()->id(),
            'movie_id' => $request->movie_id,
            'movie_title' => $request->movie_title,
            'poster' => $request->poster,
            'seatArrangement' => $request->seatArrangement,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]
    ]);

    return redirect()->route('movies.proceed');
}
    public function proceed()
    {
        $booking = session('booking');
    
        if (!$booking) {
            return redirect()->route('movies.index')->with('error', 'No booking data found.');
        }
    
        return redirect()->route('ticket.print', compact('booking'));
    }
    

    public function confirmBooking(Request $request)
    {
        $booking = session('booking');

        if (!$booking) {
            return redirect()->route('movies.index')->with('error', 'No booking data found.');
        }
        

        $request->validate([
            'payment_method' => 'required|string|in:credit_card,debit_card,paypal',
        ]);

        // Create a new booking record
        Booking::create([
            'user_id' => auth()->id(),
            'movie_id' => $booking['movie_id'],
            'movie_title' => $booking['movie_title'],
            'poster' => $booking['poster'],
            'seatArrangement' => $booking['seatArrangement'],
            'seats_booked' => $booking['quantity'], // Use quantity as seats booked
            'total_amount' => $booking['total_amount'],
            'payment_method' => $request->payment_method,
        ]);

        // Clear booking data from session
        session()->forget('booking');

        // Redirect to print ticket page after successful booking confirmation
        return redirect()->route('movies.print.ticket')->with('success', 'Booking confirmed!');

    }

    public function printTicket()
{
    $booking = session('booking');

    if (!$booking) {
        return redirect()->route('movies.index')->with('error', 'No booking data found.');
    }

    return view('movies.print-ticket', compact('booking'));
}

}
