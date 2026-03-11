<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Package;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $stats = [
            'total_bookings' => Booking::whereBetween('booking_date', [$startOfMonth, $endOfMonth])->count(),
            'total_revenue' => Booking::where('status', 'completed')
                ->whereBetween('booking_date', [$startOfMonth, $endOfMonth])
                ->sum('amount_to_pay'),
            'total_packages' => Package::count(),
            'total_portfolios' => Portfolio::count(),
        ];

        $recentBookings = Booking::with('package')
            ->whereBetween('booking_date', [$startOfMonth, $endOfMonth])
            ->latest()
            ->paginate(10);

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
