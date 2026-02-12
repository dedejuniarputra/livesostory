<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Livesostory Logo">
</p>

# Livesostory

**Professional Photography & Videography Booking Platform**

Livesostory adalah platform manajemen layanan fotografi dan videografi berbasis web yang dirancang untuk efisiensi bisnis dan pengalaman pelanggan yang premium. Sistem ini mengintegrasikan portofolio digital, pemesanan online, dan manajemen operasional dalam satu ekosistem yang kohesif.

## 🏗️ Struktur Proyek (Project Structure)

Berikut adalah gambaran umum struktur direktori utama aplikasi ini untuk memudahkan navigasi pengembangan:

```
livesostory/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Logika Back-end Dashboard Admin
│   │   │   │   ├── BookingController.php
│   │   │   │   ├── PackageController.php
│   │   │   │   └── ...
│   │   │   └── BookingController.php  # Logika Front-end Public
│   │   └── Middleware/         # Auth & Admin Security Guards
│   └── Models/                 # Eloquent ORM Models (Booking, Package, etc.)
├── database/
│   ├── migrations/             # Skema Database & Version Control
│   └── seeders/                # Data Dummy & Initial Setup
├── resources/
│   ├── css/                    # Tailwind CSS Configuration
│   └── views/                  # Blade Templates
│       ├── admin/              # Tampilan Dashboard Admin
│       ├── auth/               # Halaman Login/Register
│       └── booking/            # Flow Pemesanan User
└── routes/
    └── web.php                 # Definisi Rute Aplikasi
```

## 🗄️ Skema Database (Database Schema)

Aplikasi ini menggunakan basis data relasional yang teroptimasi:

- **Users**: Menyimpan data administrator dan petugas.
- **Packages**: Katalog layanan (Wedding, Event, Studio) beserta harga dan detailnya.
- **Bookings**: Data transaksi pemesanan, mencakup relasi ke `packages` dan status pembayaran.
- **Portfolios**: Galeri foto/video yang dikategorikan.
- **BlockedDates**: Manajemen ketersediaan jadwal untuk mencegah _double booking_.
- **PaymentAccounts**: Rekening tujuan transfer untuk pembayaran klien.
- **Settings**: Konfigurasi dinamis website (Hero image, kontak, dll).

## 🔄 Alur Kerja Sistem (System Workflow)

### 🌟 Sisi Pengguna (Client Journey)

1.  **Discovery**: Klien menjelajahi portofolio visual dan memilih paket layanan yang diinginkan.
2.  **Scheduling**: Sistem mengecek ketersediaan tanggal secara _real-time_ dari database.
3.  **Booking**: Pengisian data acara dan pemilihan metode pembayaran.
4.  **Confirmation**: Menerima detail invois dan instruksi pembayaran via WhatsApp/Email.

### 👑 Sisi Administrator (Admin Operations)

1.  **Dashboard Monitoring**: Visualisasi metrik bisnis (Total Booking, Pendapatan, Jadwal Terdekat).
2.  **Approval System**: Validasi bukti pembayaran dan perubahan status booking.
3.  **Content Management**: Update portofolio dan paket harga tanpa menyentuh kode program.
4.  **Reporting**: Export data booking ke format PDF resmi untuk dokumentasi fisik.

## 🛡️ Fitur Keamanan & Teknis

- **Role-Based Access Control (RBAC)**: Middleware khusus memastikan hanya admin terautentikasi yang dapat mengakses panel kontrol.
- **Data Validation**: Validasi input ketat di sisi server untuk integritas data.
- **Secure File Handling**: Manajemen upload portofolio yang aman.
- **CSRF Protection**: Proteksi standar Laravel untuk setiap form input.

## 💻 Spesifikasi Teknologi

Dibangun dengan stack teknologi modern yang menjamin performa dan skalabilitas:

| Komponen              | Teknologi             |
| :-------------------- | :-------------------- |
| **Backend Framework** | Laravel 10 (PHP 8.1+) |
| **Frontend Styling**  | Tailwind CSS v3       |
| **Database**          | MySQL / MariaDB       |
| **Templating Engine** | Blade                 |
| **Asset Bundler**     | Vite                  |
| **PDF Engine**        | DomPDF                |

---

<p align="center">
    Developed with ❤️ for <strong>Livesostory</strong><br>
    &copy; 2024 All Rights Reserved.
</p>
