<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('package')->latest();

        // If no filter is applied, default to current month
        if (!$request->anyFilled(['search', 'date', 'month'])) {
            $request->merge(['month' => now()->format('Y-m')]);
        }

        $this->applyFilters($query, $request);

        $totalOmset = (clone $query)->where('status', 'completed')->sum('amount_to_pay');
        $bookings = $query->paginate(10);

        return view('admin.bookings.index', compact('bookings', 'totalOmset'));
    }

    protected function applyFilters($query, Request $request)
    {
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('booking_date', $request->date);
        }

        if ($request->filled('month')) {
            // month format is YYYY-MM
            if (str_contains($request->month, '-')) {
                [$year, $month] = explode('-', $request->month);
                $query->whereYear('booking_date', $year)
                    ->whereMonth('booking_date', $month);
            }
        }

        return $query;
    }

    public function show(Booking $booking)
    {
        $booking->load('package');
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $booking->load('package');
        $packages = \App\Models\Package::ordered()->get();
        return view('admin.bookings.edit', compact('booking', 'packages'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'ig_username' => 'nullable|string|max:255',
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'location' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,completed',
            'payment_type' => 'required|in:dp,lunas',
            'amount_to_pay' => 'required|numeric|min:0',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diperbarui!');
    }

    public function markAsLunas(Booking $booking)
    {
        $booking->load('package');

        if ($booking->payment_type === 'dp') {
            $booking->update([
                'payment_type' => 'lunas',
                'amount_to_pay' => $booking->package->price
            ]);
        }

        return redirect()->back()->with('success', 'Status pembayaran berhasil diubah menjadi Lunas!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus!');
    }

    public function destroyAll()
    {
        Booking::truncate();
        return redirect()->route('admin.bookings.index')->with('success', 'Semua booking berhasil dihapus!');
    }

    public function exportAllPdf(Request $request)
    {
        $query = Booking::with('package')
            ->where('status', 'completed')
            ->latest();

        $this->applyFilters($query, $request);

        $bookings = $query->get();
        $status = 'completed';

        $pdf = Pdf::loadView('admin.bookings.export-all-pdf', compact('bookings', 'status'));

        $filename = 'Data-Booking-Completed-' . now()->format('d-m-Y') . '.pdf';

        return $pdf->download($filename);
    }

    public function exportInvoice(Booking $booking)
    {
        $booking->load('package');

        $pdf = Pdf::loadView('admin.bookings.invoice', compact('booking'))
            ->setPaper('a4', 'portrait');

        $filename = 'INVOICE - ' . Str::slug($booking->name) . '.pdf';

        return $pdf->download($filename);
    }
    public function exportExcel(Request $request)
    {
        $query = Booking::with('package')
            ->where('status', 'completed')
            ->latest();

        $this->applyFilters($query, $request);
        $bookings = $query->get();

        $filename = 'Data-Booking-Completed-' . now()->format('d-m-Y') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($bookings) {
            $file = fopen('php://output', 'w');

            // Add BOM for Excel UTF-8 support
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header
            fputcsv($file, [
                'Nama Client',
                'WhatsApp',
                'Instagram',
                'Paket',
                'Tanggal',
                'Jam',
                'Tipe Bayar',
                'Total Bayar'
            ]);

            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->name,
                    $booking->phone,
                    $booking->ig_username ?? '-',
                    $booking->package->name ?? '-',
                    $booking->booking_date->format('d/m/Y'),
                    $booking->booking_time ?? '-',
                    strtoupper($booking->payment_type),
                    $booking->amount_to_pay
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
