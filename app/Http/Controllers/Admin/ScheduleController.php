<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedDate;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $blockedDates = BlockedDate::orderBy('date')->get();
        $bookings = Booking::with('package')
            ->whereMonth('booking_date', $month)
            ->whereYear('booking_date', $year)
            ->whereNotIn('status', ['cancelled'])
            ->orderBy('booking_date')
            ->get();

        return view('admin.schedules.index', compact('blockedDates', 'bookings', 'month', 'year'));
    }

    public function blockDate(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after:today',
            'reason' => 'nullable|string|max:255',
        ]);

        BlockedDate::updateOrCreate(
            ['date' => $validated['date']],
            ['reason' => $validated['reason'] ?? null]
        );

        return redirect()->back()->with('success', 'Tanggal berhasil diblokir!');
    }

    public function unblockDate(BlockedDate $blockedDate)
    {
        $blockedDate->delete();
        return redirect()->back()->with('success', 'Tanggal berhasil dibuka kembali!');
    }
}
