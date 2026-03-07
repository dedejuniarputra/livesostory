<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('package')->latest();
        $this->applyFilters($query, $request);

        $totalOmset = (clone $query)->sum('amount_to_pay');
        $bookings = $query->paginate(15);
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
            [$year, $month] = explode('-', $request->month);
            $query->whereYear('booking_date', $year)
                ->whereMonth('booking_date', $month);
        }

        return $query;
    }

    public function show(Booking $booking)
    {
        $booking->load('package');
        return view('admin.bookings.show', compact('booking'));
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
}
