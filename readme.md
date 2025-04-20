# Restaurant Management System

## Janji
Saya Muhammad Isa Abdullah dengan NIM 2303508 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain Program
Program ini adalah sistem manajemen restoran berbasis web yang dibangun menggunakan PHP dan MySQL. Program ini memiliki fitur CRUD (Create, Read, Update, Delete) untuk mengelola data berikut:
1. **Menu**: Mengelola daftar menu restoran.
2. **Customers**: Mengelola data pelanggan.
3. **Orders**: Mengelola pesanan pelanggan.

### Struktur Tabel Database
- **`categories`**:
  - `id` (Primary Key)
  - `name`
- **`menu`**:
  - `id` (Primary Key)
  - `name`
  - `price`
  - `stock`
  - `category_id` (Foreign Key ke `categories.id`)
- **`customers`**:
  - `id` (Primary Key)
  - `name`
  - `email`
  - `phone`
- **`orders`**:
  - `id` (Primary Key)
  - `customer_id` (Foreign Key ke `customers.id`)
  - `menu_id` (Foreign Key ke `menu.id`)
  - `quantity`
  - `order_date`

---

## Penjelasan Alur Program
1. **Halaman Utama**:
   - Menampilkan navigasi ke halaman **Menu**, **Customers**, dan **Orders**.
2. **Menu**:
   - Menampilkan daftar menu restoran.
   - Fitur:
     - Tambah menu baru.
     - Edit menu yang sudah ada.
     - Hapus menu.
     - Cari menu berdasarkan nama.
3. **Customers**:
   - Menampilkan daftar pelanggan.
   - Fitur:
     - Tambah pelanggan baru.
     - Edit data pelanggan.
     - Hapus pelanggan.
     - Cari pelanggan berdasarkan nama.
4. **Orders**:
   - Menampilkan daftar pesanan.
   - Fitur:
     - Tambah pesanan baru.
     - Edit pesanan yang sudah ada.
     - Hapus pesanan.
     - Cari pesanan berdasarkan nama pelanggan atau menu.

---

## Dokumentasi Screen Record
Dokumentasi saat program dijalankan:
https://github.com/isaabdllah/TP7DPBO2025C1/blob/main/Dokumentasi_TP7.mp4

---

## Fitur Utama
- **CRUD Menu**:
  - Tambah, edit, hapus, dan cari menu restoran.
- **CRUD Customers**:
  - Tambah, edit, hapus, dan cari data pelanggan.
- **CRUD Orders**:
  - Tambah, edit, hapus, dan cari pesanan pelanggan.
- **Relasi Antar Tabel**:
  - Relasi antara tabel `menu`, `customers`, dan `orders` menggunakan foreign key.
