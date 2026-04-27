# 📑 Sistem Pelacakan Alumni (Tracer Study) - Informatics UMM

Sistem ini dirancang untuk mengelola dan melacak data alumni dalam skala besar (Big Data) secara efisien, dengan fokus pada performa tinggi dan antarmuka modern.

---

## 👤 Informasi Mahasiswa
- **Nama:** Adnan Amhar
- **NIM:** 202110370311000
- **Program Studi:** Informatika
- **Instansi:** Universitas Muhammadiyah Malang
- **Mata Kuliah:** Rekayasa Kebutuhan D

---

## 🔑 Informasi Akses (Uji Coba)

| Keterangan | Detail |
| :--- | :--- |
| **URL Lokal** | `http://localhost/pelacakan_alumni/` |
| **Username Admin** | `adnan` |
| **Password Admin** | `amhar` |
| **Basis Data** | MySQL (MariaDB) |

---

## 🚀 Fitur Utama & Prosedur Pengujian

Sistem telah diuji untuk menangani **142.000+ data alumni** tanpa mengalami kendala memori (*Memory Exhausted*).

| No | Modul Fitur | Deskripsi Teknis | Prosedur Uji | Ekspektasi Hasil |
| :-- | :--- | :--- | :--- | :--- |
| **1** | **Dashboard Modern** | Visualisasi statistik alumni berdasarkan status. | Login Admin → Dashboard. | Angka statistik tampil akurat sesuai DB. |
| **2** | **Big Data Handling** | Optimasi tabel menggunakan *Indexing* pada kolom NIM & Nama. | Buka menu Data Alumni. | Load data tetap cepat meski jumlah data masif. |
| **3** | **Smart Pagination** | Pembatasan muatan data (50 data/halaman). | Navigasi halaman di bawah tabel. | Perpindahan halaman lancar tanpa *lag*. |
| **4** | **Global Search** | Pencarian data berdasarkan Nama atau NIM. | Masukkan kata kunci di Search Bar. | Filter data muncul secara instan. |
| **5** | **Auto-Tracking** | Otomatisasi pengisian data OSINT (LinkedIn, IG, Email). | Klik tombol "Update/Lacak". | 8 data tambahan terisi otomatis (Simulasi). |
| **6** | **Integrasi Pencarian** | Deep-link ke Google, LinkedIn, & Scholar. | Klik link pada kolom Tracking. | Tab baru terbuka dengan hasil pencarian. |
| **7** | **Management CRUD** | Kontrol penuh data (Create, Read, Update, Delete). | Gunakan form Tambah/Edit. | Database terperbarui secara *real-time*. |
| **8** | **Hasil Pelacakan** | Rekapitulasi alumni yang telah teridentifikasi. | Buka menu Hasil Pelacakan. | Menampilkan profil lengkap & sosmed alumni. |
| **9** | **Modern UI/UX** | Desain Sidebar-Layout yang bersih dan responsif. | Ubah ukuran jendela browser. | Layout menyesuaikan secara otomatis. |
| **10** | **Session Guard** | Keamanan akses halaman admin. | Akses URL tanpa login. | Otomatis diarahkan kembali ke login. |

---

## 🛠️ Spesifikasi Teknologi (Tech Stack)

- **Bahasa Pemrograman:** PHP 8.x
- **Database:** MySQL (MariaDB) dengan SQL Indexing
- **Styling:** Custom CSS3 (Modern Dashboard Theme)
- **Metode Pagination:** Limit & Offset SQL Optimization
- **Keamanan:** MD5/Plain Hashing & MySQL Real Escape String

---

## 📊 Ringkasan Hasil Uji Coba

| Komponen | Status | Keterangan |
| :--- | :--- | :--- |
| **Login & Auth** | ✅ Berhasil | Proteksi sesi berjalan dengan baik. |
| **Kecepatan Query** | ✅ Berhasil | Mendukung pengolahan 140rb+ data. |
| **Otomatisasi Data** | ✅ Berhasil | Algoritma pengisian 8 poin data berfungsi. |
| **Integrasi Link** | ✅ Berhasil | Semua link eksternal mengarah dengan tepat. |
| **Responsivitas** | ✅ Berhasil | Tampilan rapi di berbagai ukuran layar. |

---

## 💡 Catatan Pengembangan
* Sistem ini menggunakan teknik **SQL Optimization** untuk mengatasi keterbatasan server lokal saat menangani data dalam jumlah besar.
* Fitur **"Lacak Otomatis"** dirancang untuk mensimulasikan hasil pelacakan *Open Source Intelligence* (OSINT) guna melengkapi data profesional alumni secara cepat.

---
*Dikembangkan oleh Adnan Amhar - Informatika UMM 2026*