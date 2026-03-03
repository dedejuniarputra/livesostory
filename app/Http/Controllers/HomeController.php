<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Package;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::active()->ordered()->get();
        $allPackages = Package::active()->ordered()->get();

        // Group by category for the landing page horizontal scroll
        $packageCategories = $allPackages->groupBy(function ($package) {
            return $package->category ?: 'Uncategorized';
        })->map(function ($packages, $category) {
            // Try to find a package that has an image to use as cover
            $packageWithImage = $packages->first(fn($p) => !empty($p->image));

            return (object) [
                'name' => $category,
                'slug' => Str::slug($category),
                'count' => $packages->count(),
                'cover_image' => $packageWithImage ? $packageWithImage->image : null,
            ];
        });

        $settings = [
            'hero_title' => Setting::get('hero_title', 'SOFT MOMENTS'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'forever told'),

            'hero_image' => Setting::get('hero_image', ''),
            'contact_image' => Setting::get('contact_image', ''),
            'whatsapp_number' => Setting::get('whatsapp_number', ''),
        ];

        return view('landing', compact('portfolios', 'packageCategories', 'settings'));
    }

    public function showCategory($categorySlug)
    {
        // Find packages matching this category slug
        $allPackages = Package::active()->ordered()->get();

        $matchedCategory = null;
        $packages = $allPackages->filter(function ($package) use ($categorySlug, &$matchedCategory) {
            $category = $package->category ?: 'Uncategorized';
            if (Str::slug($category) === $categorySlug) {
                $matchedCategory = $category;
                return true;
            }
            return false;
        });

        if ($packages->isEmpty()) {
            abort(404);
        }

        $settings = [
            'hero_image' => Setting::get('hero_image', ''),
        ];

        return view('packages.category', compact('packages', 'matchedCategory', 'settings'));
    }
}
