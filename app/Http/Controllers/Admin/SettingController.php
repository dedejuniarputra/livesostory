<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'hero_title' => Setting::get('hero_title', 'SOFT MOMENTS'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'forever told'),
            'hero_description' => Setting::get('hero_description', 'Capturing the quiet, intimate layers of your love story with a cinematic and minimalist perspective.'),
            'hero_image' => Setting::get('hero_image', ''),
            'contact_image' => Setting::get('contact_image', ''),
            'whatsapp_number' => Setting::get('whatsapp_number', ''),
            'instagram' => Setting::get('instagram', ''),
            'email' => Setting::get('email', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        try {
            $fields = ['hero_title', 'hero_subtitle', 'hero_description', 'whatsapp_number', 'instagram', 'email'];

            foreach ($fields as $field) {
                if ($request->has($field)) {
                    Setting::set($field, $request->input($field));
                }
            }

            // Handle Hero Image
            if ($request->hasFile('hero_image') && $request->file('hero_image')->isValid()) {
                $request->validate(['hero_image' => 'image|mimes:jpeg,png,jpg,webp|max:10240']);
                
                $oldImage = Setting::get('hero_image');
                if (!empty($oldImage) && !str_starts_with($oldImage, 'http')) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
                
                $image = $request->file('hero_image');
                $extension = $image->getClientOriginalExtension();
                $filename = 'settings/hero_' . uniqid() . '.' . $extension;

                Storage::disk('public')->put($filename, file_get_contents($image->getPathname()));
                Setting::set('hero_image', $filename);
            }

            // Handle Contact Image
            if ($request->hasFile('contact_image') && $request->file('contact_image')->isValid()) {
                $request->validate(['contact_image' => 'image|mimes:jpeg,png,jpg,webp|max:10240']);
                
                $oldImage = Setting::get('contact_image');
                if (!empty($oldImage) && !str_starts_with($oldImage, 'http')) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
                
                $image = $request->file('contact_image');
                $extension = $image->getClientOriginalExtension();
                $filename = 'settings/contact_' . uniqid() . '.' . $extension;

                Storage::disk('public')->put($filename, file_get_contents($image->getPathname()));
                Setting::set('contact_image', $filename);
            }

            return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteHeroImage()
    {
        return $this->deleteImage('hero_image', 'Hero image');
    }

    public function deleteContactImage()
    {
        return $this->deleteImage('contact_image', 'Contact image');
    }

    private function deleteImage($key, $label)
    {
        try {
            $oldImage = Setting::get($key);
            
            if (!empty($oldImage) && !str_starts_with($oldImage, 'http')) {
                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            Setting::set($key, '');
            
            return redirect()->route('admin.settings.index')->with('success', "$label berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()->route('admin.settings.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }

}
