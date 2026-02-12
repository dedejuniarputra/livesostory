<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BlockedDate;
use App\Models\Package;
use App\Models\PaymentAccount;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create(Package $package)
    {
        return view('booking.create', compact('package'));
    }

    public function store(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Check if date is available
        $isBlocked = BlockedDate::where('date', $validated['booking_date'])->exists();
        $isBooked = Booking::where('booking_date', $validated['booking_date'])
            ->whereNotIn('status', ['cancelled'])
            ->exists();

        if ($isBlocked || $isBooked) {
            return back()->withErrors(['booking_date' => 'Tanggal ini tidak tersedia. Silakan pilih tanggal lain.'])->withInput();
        }

        $validated['package_id'] = $package->id;
        $validated['status'] = 'pending';

        $booking = Booking::create($validated);

        return redirect()->route('booking.payment', $booking);
    }

    public function payment(Booking $booking)
    {
        $booking->load('package');
        $paymentAccounts = PaymentAccount::active()->get();
        $whatsappNumber = Setting::get('whatsapp_number', '6281234567890');

        return view('booking.payment', compact('booking', 'paymentAccounts', 'whatsappNumber'));
    }

    public function confirm(Request $request, Booking $booking)
    {
        $whatsappNumber = Setting::get('whatsapp_number', '6281234567890');

        $message = "Halo, saya ingin konfirmasi pembayaran untuk booking:\n\n"
            . "Nama: {$booking->name}\n"
            . "Paket: {$booking->package->name}\n"
            . "Tanggal: {$booking->booking_date->format('d M Y')}\n"
            . "Lokasi: {$booking->location}\n"
            . "Total: {$booking->package->formatted_price}\n\n"
            . "Berikut bukti pembayarannya.\n\n"
            . "Terima kasih!";

        $waUrl = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

        return view('booking.redirect-whatsapp', compact('waUrl'));
    }

    public function getAvailableDates(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $bookedDates = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->whereNotIn('status', ['cancelled'])
            ->pluck('booking_date')
            ->map(fn($date) => $date->format('Y-m-d'))
            ->toArray();

        $blockedDates = BlockedDate::whereBetween('date', [$startDate, $endDate])
            ->pluck('date')
            ->map(fn($date) => $date->format('Y-m-d'))
            ->toArray();

        return response()->json([
            'booked' => $bookedDates,
            'blocked' => $blockedDates,
        ]);
    }
}
