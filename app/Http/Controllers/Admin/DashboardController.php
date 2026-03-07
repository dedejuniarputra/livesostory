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
        $stats = [
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::sum('amount_to_pay'),
            'total_packages' => Package::count(),
            'total_portfolios' => Portfolio::count(),
        ];

        $recentBookings = Booking::with('package')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
