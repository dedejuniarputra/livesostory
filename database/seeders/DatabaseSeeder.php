<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
use App\Models\PaymentAccount;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Settings
        Setting::set('hero_title', 'SOFT LAYERS');
        Setting::set('hero_subtitle', 'timeless stories');

        Setting::set('hero_image', 'hero/hero_1.jpg');
        Setting::set('whatsapp_number', '6282289858037');
        Setting::set('instagram', 'https://www.instagram.com/livesostory.co');
        Setting::set('tiktok', 'https://www.tiktok.com/@akangfotoo');
        Setting::set('email', 'livesostory.co@gmail.com');
        Setting::set('payment_instructions', "• Transfer sesuai nominal paket (Tanpa pembulatan)\n• Setelah transfer, klik tombol Konfirmasi WhatsApp untuk kirim bukti\n• Booking akan dikonfirmasi dalam 1x24 jam setelah bukti diterima");

        // Portfolios
        $portfolioItems = [
            ['title' => 'Ethereal Connection', 'category' => 'Couples', 'image_path' => 'portfolio/port_1.jpg', 'sort_order' => 1],
            ['title' => 'Minimalist Portrait', 'category' => 'Editorial', 'image_path' => 'portfolio/port_2.jpg', 'sort_order' => 2],
            ['title' => 'Quiet Morning', 'category' => 'Wedding', 'image_path' => 'https://images.unsplash.com/photo-1510076857177-7470076d4098?q=80&w=2072&auto=format&fit=crop', 'sort_order' => 3],
            ['title' => 'Artistic Shadows', 'category' => 'Portrait', 'image_path' => 'portfolio/port_4.jpg', 'sort_order' => 4],
            ['title' => 'Intimate Layers', 'category' => 'Lifestyle', 'image_path' => 'portfolio/port_5.jpg', 'sort_order' => 5],
        ];

        foreach ($portfolioItems as $item) {
            \App\Models\Portfolio::create(array_merge($item, ['is_active' => true]));
        }

        // Admin User
        User::create([
            'name' => 'Admin LIVESOSTORY',
            'email' => 'admin@livesostory.co',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Packages
        Package::create([
            'name' => 'The Intimate Layer',
            'description' => 'A curated session capturing the quiet, soulful moments of your connection.',
            'price' => 2500000,
            'features' => [
                '90 Minutes Boutique Session',
                '1 Signature Location',
                '35 Master-Edited Photos',
                'Private Digital Gallery',
                'High-Resolution Delivery',
            ],
            'duration' => '90 Mins',
            'is_featured' => false,
            'sort_order' => 1,
        ]);

        Package::create([
            'name' => 'The Cinematic Story',
            'description' => 'Our signature experience. A deep dive into your narrative across multiple moods and locations.',
            'price' => 5500000,
            'features' => [
                '4 Hours Immersive Session',
                'Up to 3 Narrative Locations',
                '85 Master-Edited Photos',
                'Private Digital Gallery',
                '1 Premium Canvas (40x60)',
                'Ambient Behind-the-Scenes Film',
                'Artistic Direction',
            ],
            'duration' => '4 Hours',
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        Package::create([
            'name' => 'The Legacy Collection',
            'description' => 'An all-encompassing visual legacy. Full-day documentation of your most profound chapters.',
            'price' => 12500000,
            'features' => [
                'Full Day Narrative Coverage',
                'Unlimited Fluid Locations',
                '200+ Master-Edited Photos',
                'Cinematic Highlight Film (4K)',
                'Heirloom Fine Art Album',
                '2 Grand Format Canvases',
                'Aerial Drone Perspectives',
                'Same-Day Preview Gallery',
            ],
            'duration' => 'Full Day',
            'is_featured' => false,
            'sort_order' => 3,
        ]);

        Package::create([
            'name' => 'The Editorial Edit',
            'description' => 'High-fashion aesthetic for solo creators or personal branding.',
            'price' => 3500000,
            'features' => [
                '2 Hours Studio Session',
                'Professional Lighting Setup',
                '20 High-End Retouched Photos',
                'Vogue-Style Post Processing',
                'Social Media Assets',
            ],
            'duration' => '2 Hours',
            'is_featured' => false,
            'sort_order' => 4,
        ]);

        Package::create([
            'name' => 'The Minimalist Escape',
            'description' => 'Short, intentional session for those who value simplicity.',
            'price' => 1800000,
            'features' => [
                '45 Minutes Session',
                '1 Selected Location',
                '15 Edited Photos',
                'Rapid 48-Hour Delivery',
            ],
            'duration' => '45 Mins',
            'is_featured' => false,
            'sort_order' => 5,
        ]);

        // Payment Accounts
        PaymentAccount::create([
            'bank_name' => 'Bank BCA',
            'account_number' => '1234567890',
            'account_holder' => 'LIVESOSTORY PHOTOGRAPHY',
            'is_active' => true,
        ]);

        PaymentAccount::create([
            'bank_name' => 'Bank Mandiri',
            'account_number' => '0987654321',
            'account_holder' => 'LIVESOSTORY PHOTOGRAPHY',
            'is_active' => true,
        ]);


    }
}
