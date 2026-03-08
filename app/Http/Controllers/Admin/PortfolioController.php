<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::ordered()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = 'portfolios/' . uniqid() . '.' . $extension;

            Storage::disk('public')->put($filename, file_get_contents($image->getPathname()));
            $validated['image_path'] = $filename;
        }

        $validated['sort_order'] = Portfolio::max('sort_order') + 1;
        $validated['is_active'] = true;

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if (!empty($portfolio->image_path) && !str_starts_with($portfolio->image_path, 'http')) {
                if (Storage::disk('public')->exists($portfolio->image_path)) {
                    Storage::disk('public')->delete($portfolio->image_path);
                }
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = 'portfolios/' . uniqid() . '.' . $extension;

            Storage::disk('public')->put($filename, file_get_contents($image->getPathname()));
            $validated['image_path'] = $filename;
        }

        $validated['is_active'] = $request->has('is_active');

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if (!empty($portfolio->image_path) && !str_starts_with($portfolio->image_path, 'http')) {
            if (Storage::disk('public')->exists($portfolio->image_path)) {
                Storage::disk('public')->delete($portfolio->image_path);
            }
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio berhasil dihapus!');
    }
}
