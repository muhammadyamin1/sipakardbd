# 🩺 Sipakar DBD
**Sipakar DBD** adalah sistem pakar berbasis web untuk membantu **diagnosis dini Demam Berdarah Dengue (DBD)**.  
Dikembangkan dengan **PHP 8.3** menggunakan metode **Rule Based Reasoning (RBR)**.  
Proyek ini merupakan bagian dari **Tugas Akhir S1 Teknik Informatika** oleh *M. Yamin, S.Kom*.

🌐 **Demo Online**: [Klik di sini](https://sipakardbd.infinityfreeapp.com)

---

## ✨ Fitur Utama
- Input gejala pasien untuk diagnosis dini DBD.  
- Proses inferensi dengan metode Rule Based Reasoning (RBR).  
- Multi-level akses: **Super Admin, Admin, dan User**.  
- Laporan hasil diagnosis.  

---

## 🛠️ Tech Stack
- **PHP 8.3**  
- **MySQL / MariaDB**  
- **XAMPP** (Apache + MySQL)  
- **Bootstrap / HTML / CSS**  

---

## 🚀 Cara Instalasi
1. Ekstrak `sipakardbd.zip` ke lokasi yang diinginkan.  
2. Install **XAMPP** (`xampp-windows-x64-8.2.12-0-VS16-installer.exe`).  
3. Masuk ke `C:\xampp\htdocs`, buat folder baru `sipakardbd`.  
4. Pindahkan semua file hasil ekstrak ke dalam folder `sipakardbd`.  
5. Aktifkan **Apache** dan **MySQL** di XAMPP Control Panel.  
6. Buka browser → `http://localhost/phpmyadmin`.  
7. Buat basis data baru dengan nama `sistem_pakar_dbd`.  
8. Impor file database `sistem_pakar_dbd.sql` dari folder `database`.  
9. Klik **Impor** dan tunggu hingga selesai.  
10. Akses aplikasi via `http://localhost/sipakardbd`.  
11. Jika halaman login muncul, berarti instalasi berhasil ✅.  
12. Jangan lupa mengaktifkan Apache & MySQL setiap kali PC dinyalakan ulang.  

---

## 🔑 Akun Login Demo

### 👑 Super Admin
> Dapat menambah, mengedit, dan menghapus semua pengguna.  

### 🛠️ Admin
- **Email:** `aldi123@gmail.com`  
- **Password:** `admin`  
> Dapat mengedit pengguna (Nama & Password) dan mengakses semua menu.  

### 👤 User
1. **Email:** `riski123@gmail.com` – **Password:** `user`  
2. **Email:** `dedi@gmail.com` – **Password:** `dedi123`  
> Dapat mengakses menu Beranda, Diagnosis, Laporan, dan Tentang Aplikasi.  

---

📌 **Catatan:**  
Segera ubah password **Super Admin** setelah login pertama untuk alasan keamanan.

---

## 📜 License
This project is licensed under the 
[Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0)](http://creativecommons.org/licenses/by-nc/4.0/).

![License: CC BY-NC 4.0](https://img.shields.io/badge/License-CC%20BY--NC%204.0-lightgrey.svg)

> ⚠️ Catatan: Proyek ini bebas digunakan untuk tujuan pendidikan dan penelitian. Namun dilarang digunakan untuk tujuan komersial tanpa izin tertulis dari penulis.
