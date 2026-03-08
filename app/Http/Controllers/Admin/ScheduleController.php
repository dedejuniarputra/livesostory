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

        // Auto-delete past special date settings to keep the list clean
        BlockedDate::where('date', '<', now()->toDateString())->delete();

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
            'mode' => 'nullable|string|in:add,sub,set',
        ]);

        $dates = explode(',', $validated['dates']);
        $requestedSlots = $validated['slots'] ?? 0;
        $mode = $validated['mode'] ?? 'set';

        $defaultSlots = (int) \App\Models\Setting::get('default_slots_per_day', 1);

        foreach ($dates as $date) {
            $date = trim($date);
            if (empty($date))
                continue;

            $finalSlots = $requestedSlots;

            if ($mode === 'add') {
                $currentSetting = BlockedDate::where('date', $date)->first();
                $currentLimit = $currentSetting ? $currentSetting->slots : $defaultSlots;
                $finalSlots = $currentLimit + $requestedSlots;
            } elseif ($mode === 'sub') {
                $currentSetting = BlockedDate::where('date', $date)->first();
                $currentLimit = $currentSetting ? $currentSetting->slots : $defaultSlots;
                $finalSlots = max(0, $currentLimit - $requestedSlots);
            }

            BlockedDate::updateOrCreate(
                ['date' => $date],
                [
                    'slots' => $finalSlots
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
