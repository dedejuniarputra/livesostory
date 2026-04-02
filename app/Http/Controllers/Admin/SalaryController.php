<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalaryPayment;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class SalaryController extends Controller
{
    public function pdf(SalaryPayment $salary)
    {
        $salary->load('teamMember');

        $pdf = Pdf::loadView('admin.salary.slip', compact('salary'));

        $filename = 'slip-gaji-' . Str::slug($salary->teamMember->name) . '-' . $salary->payment_date->format('d-m-Y') . '.pdf';

        return $pdf->stream($filename);
    }

    public function index(Request $request)
    {
        $members = TeamMember::orderBy('name')->get();

        $query = SalaryPayment::with('teamMember')->latest('payment_date');

        if ($request->filled('member')) {
            $query->where('team_member_id', $request->member);
        }

        $month = $request->get('month', date('Y-m'));
        $date = $month . '-01';
        $query->whereMonth('start_date', date('m', strtotime($date)))
            ->whereYear('start_date', date('Y', strtotime($date)));

        $totalAmount = (clone $query)->sum('total_amount');
        $payments = $query->paginate(10)->withQueryString();

        return view('admin.salary.index', compact('payments', 'members', 'totalAmount'));
    }

    public function create()
    {
        $members = TeamMember::orderBy('name')->get();
        return view('admin.salary.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'start_date' => 'required|date',
            'job_description' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $validated['payment_date'] = now();
        $validated['end_date'] = $validated['start_date'];

        SalaryPayment::create($validated);

        return redirect()->route('admin.salary.index')
            ->with('success', 'Data pembayaran gaji berhasil disimpan.');
    }

    public function edit(SalaryPayment $salary)
    {
        $members = TeamMember::orderBy('name')->get();
        return view('admin.salary.edit', compact('salary', 'members'));
    }

    public function update(Request $request, SalaryPayment $salary)
    {
        $validated = $request->validate([
            'team_member_id' => 'required|exists:team_members,id',
            'start_date' => 'required|date',
            'job_description' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $validated['end_date'] = $validated['start_date'];

        $salary->update($validated);

        return redirect()->route('admin.salary.index')
            ->with('success', 'Data pembayaran gaji berhasil diperbarui.');
    }

    public function destroy(SalaryPayment $salary)
    {
        $salary->delete();

        return redirect()->route('admin.salary.index')
            ->with('success', 'Data pembayaran gaji berhasil dihapus.');
    }
}
