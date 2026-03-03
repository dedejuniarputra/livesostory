<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::ordered()->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'features' => 'nullable|string',
            'item_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'duration' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['features'] = $validated['features']
            ? array_map('trim', explode("\n", $validated['features']))
            : [];

        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        // Handle item images
        if ($request->hasFile('item_images')) {
            $itemImages = [];
            foreach ($request->file('item_images') as $file) {
                $itemImages[] = $file->store('packages/items', 'public');
            }
            $validated['item_images'] = $itemImages;
        }

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'features' => 'nullable|string',
            'item_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'duration' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['features'] = $validated['features']
            ? array_map('trim', explode("\n", $validated['features']))
            : [];

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        // Handle item images (Replace Strategy)
        if ($request->hasFile('item_images')) {
            // Delete old item images
            if ($package->item_images) {
                foreach ($package->item_images as $oldItem) {
                    Storage::disk('public')->delete($oldItem);
                }
            }

            $itemImages = [];
            foreach ($request->file('item_images') as $file) {
                $itemImages[] = $file->store('packages/items', 'public');
            }
            $validated['item_images'] = $itemImages;
        }

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dihapus!');
    }
}
