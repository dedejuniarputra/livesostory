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
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'completed_bookings' => Booking::where('status', 'completed')->count(),
            'total_revenue' => Booking::whereIn('status', ['confirmed', 'completed'])->with('package')->get()->sum(fn($b) => $b->package->price),
            'total_packages' => Package::count(),
            'total_portfolios' => Portfolio::count(),
            'unread_contacts' => Contact::unread()->count(),
        ];

        $recentBookings = Booking::with('package')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
