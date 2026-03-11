<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $allMembers = TeamMember::orderBy('name')->get();

        $query = TeamMember::withCount('salaryPayments')
            ->latest();

        $month = $request->get('month', date('Y-m'));
        $monthDate = $month . '-01';

        // Apply month constraint to sum
        $query->withSum([
            'salaryPayments as salary_payments_sum_total_amount' => function ($q) use ($monthDate) {
                $q->whereMonth('start_date', date('m', strtotime($monthDate)))
                    ->whereYear('start_date', date('Y', strtotime($monthDate)));
            }
        ], 'total_amount');

        if ($request->filled('member')) {
            $query->where('id', $request->member);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $members = $query->paginate(10)->withQueryString();

        return view('admin.team.index', compact('members', 'allMembers'));
    }

    public function report(TeamMember $team)
    {
        $team->load([
            'salaryPayments' => function ($query) {
                $query->latest('payment_date');
            }
        ]);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.team.report', compact('team'));

        $filename = 'laporan-gaji-' . str_replace(' ', '-', strtolower($team->name)) . '.pdf';

        return $pdf->stream($filename);
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bank_account' => 'nullable|string|max:255',
        ]);

        $validated['role'] = 'Team';

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bank_account' => 'nullable|string|max:255',
        ]);

        $team->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Data anggota tim berhasil diperbarui.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Anggota tim berhasil dihapus.');
    }
}
