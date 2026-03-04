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

        // Fetch categories directly from the new Category model
        $packageCategories = \App\Models\Category::active()->ordered()->withCount('packages')->get();

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
        $category = \App\Models\Category::where('slug', $categorySlug)->firstOrFail();

        // Find packages matching this category ID
        $packages = Package::where('category_id', $category->id)->active()->ordered()->get();
        $matchedCategory = $category->name;

        $settings = [
            'hero_image' => Setting::get('hero_image', ''),
        ];

        return view('packages.category', compact('packages', 'matchedCategory', 'category', 'settings'));
    }
}
