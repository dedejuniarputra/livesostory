<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

use App\Models\Category;
use App\Models\Package;

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$categories = Category::active()->get();
$packages = Package::active()->get();

$xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// Home
$xml .= '    <url>' . PHP_EOL;
$xml .= '        <loc>https://livesostory.online/</loc>' . PHP_EOL;
$xml .= '        <lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL;
$xml .= '        <changefreq>daily</changefreq>' . PHP_EOL;
$xml .= '        <priority>1.0</priority>' . PHP_EOL;
$xml .= '    </url>' . PHP_EOL;

// Categories
foreach ($categories as $category) {
    $xml .= '    <url>' . PHP_EOL;
    $xml .= '        <loc>https://livesostory.online/packages/' . $category->slug . '</loc>' . PHP_EOL;
    $xml .= '        <lastmod>' . ($category->updated_at ? $category->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>' . PHP_EOL;
    $xml .= '        <changefreq>weekly</changefreq>' . PHP_EOL;
    $xml .= '        <priority>0.8</priority>' . PHP_EOL;
    $xml .= '    </url>' . PHP_EOL;
}

// Packages
foreach ($packages as $package) {
    $xml .= '    <url>' . PHP_EOL;
    $xml .= '        <loc>https://livesostory.online/booking/' . $package->id . '</loc>' . PHP_EOL;
    $xml .= '        <lastmod>' . ($package->updated_at ? $package->updated_at->format('Y-m-d') : date('Y-m-d')) . '</lastmod>' . PHP_EOL;
    $xml .= '        <changefreq>weekly</changefreq>' . PHP_EOL;
    $xml .= '        <priority>0.8</priority>' . PHP_EOL;
    $xml .= '    </url>' . PHP_EOL;
}

$xml .= '</urlset>';

file_put_contents(__DIR__ . '/public/sitemap.xml', $xml);
echo "Sitemap generated successfully in public/sitemap.xml\n";
