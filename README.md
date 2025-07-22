# 🌐 LaporIn - Aplikasi Pelaporan dan Donasi Bencana

**LaporIn** adalah aplikasi berbasis Laravel yang memungkinkan masyarakat untuk:
- Melaporkan kejadian seperti bencana alam, ketidakadilan, atau masalah fasilitas umum
- Melakukan donasi untuk laporan bencana yang sedang diproses
- Melihat status tindak lanjut laporan mereka
- Memilih untuk membuat laporan secara anonim

---

## 🚀 Fitur Utama

- 📝 Form pelaporan publik
- ✅ Laporan dengan status (pending, diproses, selesai)
- 🧾 Filter laporan berdasarkan status
- 🔐 Pelaporan anonim (nama akan tampil sebagai "anonim")
- 💸 Sistem donasi hanya untuk laporan bencana berstatus **diproses**
- 📥 Riwayat donasi dan laporan
- 👤 Manajemen user & admin (middleware Laravel)

---

## 🛠️ Teknologi yang Digunakan

- **Laravel 12**
- **MySQL** (bisa SQLite pada versi mobile)
- **Tailwind CSS**
- **Blade Templating**
- **PHP 8+**

---

## 📦 Instalasi Lokal

1. Clone repository:
   ```bash
   git clone https://github.com/username/laporin.git
   cd laporin
2. Install Dependency:
   ```bash
   composer install
   npm install && npm run build
3. Setup file environtment
   ```bash
   cp .env.example .env
   php artisan key:generate

5. Konfigurasi database di .env
   ```bash
   DB_DATABASE=laporin
   DB_USERNAME=root
   DB_PASSWORD=
7. jalankan migrasi
   ```bash
   php artisan migrate
9. jalankan server lokal
    ```bash
    php artisan serve
📂 Struktur Fitur Utama
File / Folder	Fungsi
routes/web.php	Routing aplikasi frontend/admin
app/Http/Controllers	Logic aplikasi untuk laporan, donasi, admin
resources/views/lapor.blade.php	Halaman utama daftar laporan & filter
resources/views/form_donasi.blade.php	Formulir donasi laporan bencana
app/Models/Laporan.php	Model database laporan
database/migrations	Struktur tabel Laravel

🔐 Role dan Middleware
user → Membuat laporan & donasi

admin → Mengelola data laporan, instansi, user, donasi

Middleware admin untuk dashboard hanya admin

📜 Lisensi
Proyek ini dilisensikan di bawah MIT License.

🤝 Kontribusi
Pull Request sangat diterima. Silakan fork repo ini dan buat perubahan.

📧 Kontak
Pengembang: Iamho Pegodang, Geovano Galan, Mochamad Rafi Djaenal

## 👥 Kontributor

![GitHub contributors](https://img.shields.io/github/contributors/Eltiamho/WebLaporin?style=flat-square)
![GitHub contributors](https://img.shields.io/github/contributors/ZPINXD/Laporin?style=flat-square)
![GitHub contributors](https://img.shields.io/github/contributors/MochamadRafiDjaenalPratama/WebLaporin?style=flat-square)

Terima kasih kepada semua yang telah berkontribusi!

- [@Eltiamho](https://github.com/Eltiamho)
- [@ZPINXD](https://github.com/ZPINXD)
- [@MochamadRafiDjaenalPratama](https://github.com/MochamadRafiDjaenalPratama)
