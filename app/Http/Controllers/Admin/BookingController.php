<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('package')->latest();

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('package');
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed',
        ]);

        $booking->update($validated);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus!');
    }

    public function exportPdf(Booking $booking)
    {
        $booking->load('package');
        
        $pdf = \PDF::loadView('admin.bookings.pdf', compact('booking'));
        
        $filename = 'Booking-' . $booking->id . '-' . $booking->name . '.pdf';
        
        return $pdf->download($filename);
    }
}
