# Hakim Printing - Undangan Pernikahan

Proyek sistem pemesanan percetakan undangan pernikahan menggunakan framework Laravel dengan integrasi *Payment Gateway* Midtrans dan *Shipping API* RajaOngkir.

## Cara Menjalankan Proyek di Komputer Baru

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi:

### 1. Instalasi Dependensi (Wajib!)
Karena folder `vendor` dihapus sebelum dikompres menjadi `.zip` agar ukurannya kecil, Anda **wajib** menginstal kembali dependensinya. Buka Terminal / Command Prompt, arahkan ke folder proyek ini, dan jalankan:

```bash
composer install
```
*(Jika library Midtrans gagal terbaca, jalankan: `composer require midtrans/midtrans-php`)*

### 2. Konfigurasi Environment (`.env`)
1. Di dalam folder proyek, *copy* file `.env.example` dan ubah namanya menjadi `.env` (atau cukup hapus ekstensi `.example` nya).
2. Buka file `.env` menggunakan teks editor (Notepad / VS Code).
3. Cari pengaturan koneksi database, dan ubah nama databasenya menjadi `hakim_printing`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hakim_printing
DB_USERNAME=root
DB_PASSWORD=
```
*(Sesuaikan password dengan settingan XAMPP/MySQL Anda, biasanya dibiarkan kosong).*

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
*(Catatan: perintah `migrate:fresh --seed` akan membangun struktur tabel sekaligus mengisi akun admin dan produk dummy ke database Anda. Perintah `storage:link` agar gambar-gambar bisa dimuat di layar).*

### 4. Nyalakan Aplikasi
Semuanya sudah siap! Jalankan server lokal Laravel dengan:
```bash
php artisan serve
```
Kunjungi **http://127.0.0.1:8000** di *browser* Anda.

---

## Data Akun Admin
Jika Anda perlu masuk ke Dasbor Admin untuk memproses pesanan dan menginput resi pengiriman, gunakan data login berikut:
*   **Email:** `admin@hakimprinting.com`
*   **Password:** `Admin123!`

*(Untuk login sebagai user/pembeli biasa, silakan melakukan registrasi mandiri di halaman Sign Up).*

---

## Panduan Demo (Presentasi)

### Simulasi Pembayaran (Midtrans Sandbox)
Karena kita menggunakan mode **Sandbox** (Uang Simulasi/Mainan), Anda harus menggunakan situs simulator dari Midtrans untuk "membayar" pesanan.
1. Saat selesai *checkout*, *popup* Midtrans akan muncul.
2. Pilih metode pembayaran, **BCA Virtual Account** sangat direkomendasikan karena paling mudah.
3. *Copy* (Salin) nomor Virtual Account yang muncul.
4. Kunjungi situs Simulator BCA Midtrans: **[https://simulator.sandbox.midtrans.com/bca/payment](https://simulator.sandbox.midtrans.com/bca/payment)**
5. *Paste* nomor Virtual Account tadi, lalu klik **Inquire**, dan klik **Pay**.
6. Kembali ke website Hakim Printing, sistem akan mendeteksi pembayaran sukses dan otomatis memindahkan pesanan ke menu "Diproses".

### Simulasi Email Notification
Sistem akan otomatis merakit Email berformat HTML setiap kali pembayaran sukses, yang ditujukan ke pembeli dan admin. Karena web tidak di-hosting ke server online (masih *localhost*), maka **email tidak dikirim ke Gmail asli**.
Sebagai gantinya, Anda bisa mendemonstrasikan visual email ini dengan cara:
1. Selesaikan pembayaran satu pesanan (sebagai User biasa).
2. Masuk ke halaman **Diproses** di Dasbor User Anda.
3. Di dalam kotak rincian pesanan tersebut, terdapat tombol **"Lihat Bukti Email"**.
4. Klik tombol tersebut, dan browser akan langsung menampilkan *preview* desain HTML dari Mailable (Notifikasi Pesanan) yang 100% identik dengan yang akan masuk ke *inbox* pelanggan!
