<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'hero_title', 'value' => 'SOFT LAYERS'],
            ['key' => 'hero_subtitle', 'value' => 'timeless stories'],
            ['key' => 'hero_description', 'value' => 'We capture the quiet, intimate layers of your narrative through a cinematic and minimalist lens. Every frame is a tribute to the unseen'],
            ['key' => 'hero_image', 'value' => 'https://images.unsplash.com/photo-1472396961693-142e6e269027?q=80&w=2070&auto=format&fit=crop'],
            ['key' => 'whatsapp_number', 'value' => '628123456789'],
            ['key' => 'instagram', 'value' => '@livesostory.co'],
            ['key' => 'email', 'value' => 'contact@livesostory.co'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
