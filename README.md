# Tutorial Pengaturan Proyek Laravel

Tutorial ini membimbing Anda melalui pengaturan proyek Laravel setelah mengkloningnya dari GitHub. Laravel, yang dikenal dengan sintaksnya yang ekspresif dan elegan, membuat pengembangan web menjadi menyenangkan dan kreatif. Ikuti langkah-langkah ini untuk menjalankan aplikasi Laravel Anda.

## Prasyarat

-   Git terinstal di sistem Anda.
-   PHP dan Composer terinstal.
-   Pemahaman dasar tentang Laravel (opsional).

## Langkah 1: Mengkloning Repositori

1. Buka terminal Anda.
2. Kloning repositori Laravel dengan menjalankan:
3. Navigasi ke direktori yang telah dikloning:

## Langkah 2: Menginstal Dependensi

1. Instal dependensi PHP menggunakan Composer:

## Langkah 3: Mengatur Lingkungan

1. Salin file `.env.example` untuk membuat file `.env`:

2. Hasilkan kunci aplikasi: `php artisan key:generate`

3. Konfigurasikan database Anda dan layanan lainnya di file `.env`.

## Langkah 4: Migrasi Database

1. Jalankan migrasi untuk mengatur skema database Anda: `php artisan migrate`

## Langkah 5: Menjalankan Seeder

1. Jalankan seeder untuk mengisi database Anda dengan data: `php artisan db:seed`

## Langkah 6: Menjalankan Aplikasi

1. Mulai server Laravel: `php artisan serve`

2. Kunjungi `http://localhost:8000` di browser Anda untuk melihat aplikasi Anda.
