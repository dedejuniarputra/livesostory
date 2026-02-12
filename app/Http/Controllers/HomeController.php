<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Package;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::active()->ordered()->get();
        $packages = Package::active()->ordered()->get();

        $settings = [
            'hero_title' => Setting::get('hero_title', 'SOFT MOMENTS'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'forever told'),
            'hero_description' => Setting::get('hero_description', 'Capturing the quiet, intimate layers of your love story with a cinematic and minimalist perspective.'),
            'hero_image' => Setting::get('hero_image', ''),
            'contact_image' => Setting::get('contact_image', ''),
            'whatsapp_number' => Setting::get('whatsapp_number', ''),
        ];

        return view('landing', compact('portfolios', 'packages', 'settings'));
    }
}
