# Aplikasi Pengelolaan Beasiswa
Aplikasi untuk **Modul 1: Penetapan Beasiswa dari SK** di UIN Palopo.

## Stack
- Laravel 12 / PHP 8.2+
- Vue 3 + Inertia.js
- Tailwind CSS 4
- PostgreSQL

## Mulai lokal
1. Pastikan PHP 8.2+, Composer, Node.js/npm, dan PostgreSQL tersedia.
2. Salin \`.env.example\` menjadi \`.env\`, lalu isi konfigurasi PostgreSQL.
3. Jalankan \`composer install\`, \`php artisan key:generate\`, \`npm install\`, \`npm run dev\`, dan \`php artisan serve\`.

## Prinsip penting
- SK adalah sumber kebenaran; aplikasi tidak mengubah isi SK secara otomatis.
- Versi yang telah ditetapkan tidak boleh diedit langsung.
- Maksimal satu versi aktif per SK.
- Pembuat versi tidak boleh memverifikasi versi yang sama.
- Data rekening harus dilindungi.
- Aturan bisnis yang belum dikonfirmasi dicatat sebagai keputusan terbuka, bukan diasumsikan.

Lihat [rencana implementasi Modul 1](docs/IMPLEMENTASI-MODUL-1.md).
