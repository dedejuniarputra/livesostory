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
        $month = (int) $request->get('month', now()->month);
        $year = (int) $request->get('year', now()->year);

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        // Get blocked dates for this month
        $blockedDates = BlockedDate::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get()
            ->keyBy(fn($item) => $item->date->format('Y-m-d'));

        // Get all blocked dates for the 'Special Settings' list (only fetch upcoming ones)
        $allBlockedDates = BlockedDate::where('date', '>=', now()->startOfDay())
            ->orderBy('date')
            ->get();

        $bookings = Booking::with('package')
            ->whereBetween('booking_date', [$startDate, $endDate])
            ->orderBy('booking_date')
            ->get()
            ->groupBy(fn($item) => $item->booking_date->format('Y-m-d'));

        return view('admin.schedules.index', [
            'blockedDates' => $blockedDates,
            'allBlockedDates' => $allBlockedDates,
            'bookings' => $bookings,
            'month' => $month,
            'year' => $year,
            'defaultSlots' => (int) \App\Models\Setting::get('default_slots_per_day', 1)
        ]);
    }

    public function blockDate(Request $request)
    {
        $validated = $request->validate([
            'dates' => 'required|string', // Support multiple dates separated by comma
            'slots' => 'nullable|integer|min:0',
            'reason' => 'nullable|string|max:255',
        ]);

        $dates = explode(',', $validated['dates']);
        $slots = $validated['slots'] ?? 0;

        foreach ($dates as $date) {
            $date = trim($date);
            if (empty($date))
                continue;

            BlockedDate::updateOrCreate(
                ['date' => $date],
                [
                    'reason' => $validated['reason'] ?? null,
                    'slots' => $slots
                ]
            );
        }

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function unblockDate(BlockedDate $blockedDate)
    {
        $blockedDate->delete();
        return redirect()->back()->with('success', 'Tanggal berhasil dibuka kembali!');
    }

    public function purge()
    {
        BlockedDate::truncate();
        return redirect()->back()->with('success', 'Semua pengaturan tanggal khusus berhasil dihapus!');
    }
}
