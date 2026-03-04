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
            'phone' => 'required|numeric|digits_between:10,13',
            'address' => 'nullable|string',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Check if date is available
        $defaultSlots = (int) Setting::get('default_slots_per_day', 1);
        $dateSetting = BlockedDate::where('date', $validated['booking_date'])->first();

        $maxSlots = $dateSetting ? $dateSetting->slots : $defaultSlots;
        $currentBookings = Booking::where('booking_date', $validated['booking_date'])
            ->count();

        if ($currentBookings >= $maxSlots) {
            $errorMsg = $maxSlots === 0 ? 'Tanggal ini tidak tersedia (Libur). Silakan pilih tanggal lain.' : 'Slot untuk tanggal ini baru saja penuh oleh pemesan lain. Silakan pilih jadwal lainnya.';
            return back()->withErrors(['booking_date' => $errorMsg])->withInput();
        }

        $validated['package_id'] = $package->id;
        $validated['status'] = 'completed';

        $booking = Booking::create($validated);

        return redirect()->route('booking.payment', $booking);
    }

    public function payment(Booking $booking)
    {
        $booking->load('package');
        $paymentAccounts = PaymentAccount::active()->get();
        $whatsappNumber = Setting::get('whatsapp_number', '6281234567890');
        $paymentInstructions = Setting::get('payment_instructions', '');

        return view('booking.payment', compact('booking', 'paymentAccounts', 'whatsappNumber', 'paymentInstructions'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status === 'pending') {
            $booking->delete();
        }

        if (request()->wantsJson()) {
            return response()->json(['status' => 'success']);
        }

        return redirect()->route('booking.create', $booking->package_id)
            ->with('info', 'Pesanan sebelumnya telah dibatalkan. Silakan pilih jadwal baru.');
    }

    public function confirm(Request $request, Booking $booking)
    {
        $whatsappNumber = Setting::get('whatsapp_number', '6281234567890');

        $message = "Halo, saya ingin konfirmasi pembayaran untuk booking:\n\n"
            . "Nama: {$booking->name}\n"
            . "Paket: {$booking->package->name}\n"
            . "Tanggal: {$booking->booking_date->format('d M Y')}\n"
            . "Lokasi: {$booking->location}\n"
            . ($booking->notes ? "Catatan: {$booking->notes}\n" : "")
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

        $defaultSlots = (int) Setting::get('default_slots_per_day', 1);

        // Get all custom date settings (overrides or blocks)
        $dateSettings = BlockedDate::whereBetween('date', [$startDate, $endDate])
            ->get()
            ->keyBy(fn($item) => $item->date->format('Y-m-d'));

        // Get booking counts per date
        $bookingCounts = Booking::whereBetween('booking_date', [$startDate, $endDate])
            ->selectRaw('booking_date, count(*) as total')
            ->groupBy('booking_date')
            ->get()
            ->keyBy(fn($item) => $item->booking_date->format('Y-m-d'));

        $datesInfo = [];
        $tempDate = $startDate->copy();
        while ($tempDate->lte($endDate)) {
            $dateStr = $tempDate->format('Y-m-d');

            $maxSlots = isset($dateSettings[$dateStr]) ? $dateSettings[$dateStr]->slots : $defaultSlots;
            $bookedCount = isset($bookingCounts[$dateStr]) ? $bookingCounts[$dateStr]->total : 0;

            $datesInfo[$dateStr] = [
                'total_slots' => $maxSlots,
                'booked_slots' => $bookedCount,
                'remaining_slots' => max(0, $maxSlots - $bookedCount),
                'is_blocked' => $maxSlots === 0,
                'reason' => isset($dateSettings[$dateStr]) ? $dateSettings[$dateStr]->reason : null,
            ];

            $tempDate->addDay();
        }

        return response()->json([
            'dates' => $datesInfo,
            'default_slots' => $defaultSlots
        ]);
    }
}
