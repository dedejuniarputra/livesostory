<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\BlockedDate;
use App\Models\Setting;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function create()
    {
        return view('admin.vendor.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'custom_package_name' => 'required|string|max:255',
            'custom_package_features' => 'nullable|string',
            'package_price' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'ig_username' => 'nullable|string|max:255',
            'phone' => 'nullable|string',
            'booking_date' => 'required|date',
            'booking_time' => 'required|string',
            'payment_type' => 'required|in:lunas,dp',
            'down_payment' => 'required_if:payment_type,dp|numeric|min:0|nullable',
            'location' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:completed',
        ]);

        // Check if date is available (though admin could theoretically bypass, it's safer to warn/fail if full, or maybe just proceed. Let's strictly check for now, or just allow admin to override? For simplicity, we can let admin override or just check.)
        $defaultSlots = (int) Setting::get('default_slots_per_day', 1);
        $dateSetting = BlockedDate::where('date', $validated['booking_date'])->first();

        $maxSlots = $dateSetting ? $dateSetting->slots : $defaultSlots;
        $currentBookings = Booking::where('booking_date', $validated['booking_date'])
            ->where(function ($query) {
                $query->where('status', '!=', 'pending')
                    ->orWhere(function ($q) {
                        $q->where('status', 'pending')
                            ->where('created_at', '>=', now()->subMinutes(10));
                    });
            })
            ->count();

        if ($currentBookings >= $maxSlots) {
            return back()->withErrors(['booking_date' => 'Perhatian: Slot untuk tanggal ini sudah penuh/dilakukan blokir. (Admin tetap bisa memaksa tapi ini dicegah sementara. Hubungi developer jika ingin bypass).'])->withInput();
        }

        // Create a hidden custom package on the fly
        $featuresArray = [];
        if (!empty($validated['custom_package_features'])) {
            $featuresArray = array_map('trim', explode("\n", $validated['custom_package_features']));
            $featuresArray = array_filter($featuresArray); // Remove empty lines
        }

        $package = Package::create([
            'name' => $validated['custom_package_name'],
            'description' => 'Custom package created via Vendor Manual Booking',
            'price' => $validated['package_price'],
            'down_payment' => $validated['down_payment'] ?? 0,
            'features' => $featuresArray,
            'is_active' => false, // Hide from public
        ]);

        $validated['package_id'] = $package->id;

        $validated['amount_to_pay'] = $validated['payment_type'] === 'dp' ? ($validated['down_payment'] ?? 0) : $validated['package_price'];

        Booking::create($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Pesanan (Vendor) berhasil ditambahkan!');
    }
}
