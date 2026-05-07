# Hakim Printing - Undangan Pernikahan

Proyek sistem pemesanan percetakan undangan pernikahan menggunakan framework Laravel dengan integrasi *Payment Gateway* Midtrans.

## Cara Menjalankan Proyek di Komputer Baru

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi:

### 1. Instalasi Dependensi (Wajib!)
Karena folder `vendor` dihapus sebelum dikompres menjadi `.zip` agar ukurannya kecil, Anda **wajib** menginstal kembali dependensinya. Buka Terminal / Command Prompt, arahkan ke folder proyek ini, dan jalankan:

```bash
composer install
```
Jika karena alasan tertentu *library* Midtrans belum ikut terinstal, jalankan perintah ini juga:
```bash
composer require midtrans/midtrans-php
```

### 2. Konfigurasi Environment (`.env`)
1. Di dalam folder proyek, *copy* file `.env.example` dan ubah namanya menjadi `.env` (atau hapus ekstensi `.example` nya).
2. Buka file `.env` tersebut menggunakan teks editor.
3. Cari pengaturan koneksi database, dan ubah nama databasenya menjadi `hakim_printing`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hakim_printing
DB_USERNAME=root
DB_PASSWORD=
```
*(Sesuaikan password dengan settingan XAMPP/MySQL Anda, biasanya kosong).*

### 3. Setup Database (XAMPP & Migrasi)
1. Buka XAMPP Control Panel, lalu nyalakan **Apache** dan **MySQL**.
2. Buka browser, kunjungi `http://localhost/phpmyadmin`.
3. Buat database baru dengan nama persis: **`hakim_printing`**.
4. Kembali ke Terminal di folder proyek Anda, lalu jalankan tiga perintah ini secara berurutan:
```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```
*(Catatan: perintah `migrate:fresh --seed` akan membangun struktur tabel sekaligus mengisi produk dummy ke database Anda. Perintah `storage:link` agar gambar bisa dimuat).*

### 4. Nyalakan Aplikasi
Semuanya sudah siap! Jalankan server lokal Laravel dengan:
```bash
php artisan serve
```
Kunjungi **http://127.0.0.1:8000** di *browser* Anda.

---

## Simulasi Pembayaran (Midtrans)

Karena kita menggunakan mode **Sandbox** (Uang Simulasi/Mainan), Anda harus menggunakan situs simulator dari Midtrans untuk "membayar" pesanan.

1. Saat Anda selesai *checkout* di web Hakim Printing, *popup* Midtrans akan muncul.
2. Pilih metode pembayaran, misalnya **BCA Virtual Account**.
3. *Copy* (Salin) nomor Virtual Account yang tertera di layar.
4. Buka tab browser baru dan kunjungi situs Simulator BCA Midtrans:
   👉 **[https://simulator.sandbox.midtrans.com/bca/payment](https://simulator.sandbox.midtrans.com/bca/payment)**
5. Tempel (*Paste*) nomor Virtual Account tadi, lalu klik **Inquire**, kemudian klik **Pay**.
6. Selesai! Kembali ke tab website Hakim Printing, status pesanan Anda akan otomatis sukses dan masuk ke bagian "Diproses".
