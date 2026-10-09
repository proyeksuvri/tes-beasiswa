# Rencana Implementasi — Modul 1 Penetapan Beasiswa dari SK

## Tujuan
Membangun Modul 1 berdasarkan PRD dan addendum: menetapkan penerima beasiswa dari SK, menjaga riwayat versi, dan menyediakan pemeriksaan serta audit. Modul pembayaran dan rekonsiliasi berada di luar cakupan.

## Stack yang ditetapkan PRD
- Backend: Laravel
- Frontend: Vue.js + Inertia
- UI: shadcn-vue + Tailwind CSS
- Database: PostgreSQL

## Urutan pengerjaan
1. **Fondasi proyek dan akses** — scaffold Laravel, konfigurasi PostgreSQL, autentikasi, role/permission, dan audit dasar.
2. **Master data dan SK** — program, kategori, penerbit, periode, fakultas, program studi, bank, mahasiswa, SK, dan versi SK.
3. **Import dan staging** — unggah Excel, validasi format, simpan data staging, dan cegah duplikasi import.
4. **Pemeriksaan data** — tampilkan temuan tanpa mengubah otomatis isi SK.
5. **Verifikasi dan penetapan** — pisahkan operator dan verifikator; pembuat versi tidak boleh memverifikasi versi yang sama.
6. **Revisi versi** — versi yang telah ditetapkan tidak diedit langsung; revisi membuat versi baru dan menjaga histori.
7. **Audit, perbandingan, dan ekspor** — rekam tindakan penting dan sediakan keluaran sesuai PRD.

## Prinsip yang tidak boleh dilanggar
- SK menjadi sumber kebenaran; sistem tidak mengoreksi isi SK secara otomatis.
- Versi yang sudah ditetapkan bersifat immutable.
- Maksimal satu versi aktif untuk setiap SK.
- Data rekening harus dilindungi dan tidak bocor pada log atau ekspor yang tidak berwenang.
- Aturan bisnis divalidasi di backend/database, bukan hanya di UI.
- Aturan bisnis yang belum dipastikan tidak boleh diasumsikan; tandai sebagai keputusan yang perlu dikonfirmasi.

## Kriteria awal fondasi
- Aplikasi berjalan dengan konfigurasi PostgreSQL.
- Hak akses ditegakkan di backend.
- Struktur audit tersedia untuk tindakan penting.
- Tes awal mencakup pemisahan tugas dan perlindungan data sensitif.

## Langkah berikutnya
Siapkan scaffold Laravel + Vue/Inertia yang dapat dijalankan, lalu tambahkan migrasi awal dan autentikasi sebelum mengimplementasikan master data.
