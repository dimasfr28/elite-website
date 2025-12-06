# ELITE Management System

![ELITE Logo](assets/img/logoutama1.png)

## 📋 Overview

**ELITE (Electronic Innovation Center)** adalah sistem digitalisasi administrasi organisasi robotika SMKN 2 Surabaya yang dirancang untuk mengelola seluruh aspek operasional ekstrakurikuler robotika secara efisien dan terstruktur.

Sistem ini menyediakan platform terpadu untuk:
- **Manajemen Anggota** - Pendaftaran, verifikasi, dan pengelolaan data anggota
- **Manajemen Kas** - Pencatatan pemasukan, pengeluaran, dan laporan keuangan
- **Manajemen Inventaris** - Peminjaman barang, tracking stok, dan administrasi inventaris
- **Sistem Verifikasi** - Workflow approval berbasis role untuk peminjaman dan pendaftaran
- **Laporan Otomatis** - Generate laporan PDF untuk kas dan inventaris

## ✨ Fitur Utama

### 🔐 Multi-Role Access System
Sistem mendukung 5 level akses pengguna dengan hak akses berbeda:

1. **Admin (Role 1)**
   - Verifikasi pendaftaran anggota baru
   - Manajemen user (tambah, edit, hapus)
   - Manajemen kelas
   - Posting pengumuman dan achievement
   - Akses penuh ke semua laporan

2. **Inventaris (Role 2)**
   - Manajemen barang inventaris (CRUD)
   - Verifikasi peminjaman barang
   - Monitoring stok barang
   - Laporan inventaris (bulanan & keseluruhan)

3. **Bendahara (Role 3)**
   - Pencatatan pemasukan anggota
   - Pencatatan pengeluaran organisasi
   - Generate laporan kas (bulanan & keseluruhan)
   - Monitoring saldo kas

4. **Member/Siswa (Role 4)**
   - Peminjaman barang inventaris
   - Tracking history peminjaman
   - Update profil pribadi

5. **Alumni (Role 5)**
   - Akses terbatas untuk alumni
   - View informasi organisasi
   - Peminjaman barang (dengan approval)

### 📦 Manajemen Inventaris
- **Katalog Barang**: Daftar lengkap dengan foto, kategori, dan stok
- **Cart System**: Keranjang peminjaman multi-item
- **Status Tracking**: Pending, Approved, Dikembalikan
- **Notifikasi**: Alert untuk barang tidak tersedia
- **History**: Riwayat peminjaman per user

### 💰 Manajemen Kas
- **Pemasukan Siswa**: Tracking saldo per anggota
- **Pengeluaran**: Pencatatan detail pengeluaran organisasi
- **Saldo Real-time**: Kalkulasi otomatis sisa kas
- **Kategori**: Pengelompokan transaksi

### 📊 Sistem Pelaporan
- **PDF Generator**: Menggunakan mPDF untuk laporan profesional
- **Laporan Kas**:
  - Laporan Bulanan
  - Laporan Keseluruhan
  - Detail pemasukan & pengeluaran
- **Laporan Inventaris**:
  - Laporan Bulanan
  - Laporan Keseluruhan
  - Status peminjaman

### 🎯 Fitur Tambahan
- **Landing Page**: Informasi ekstrakurikuler dengan counter statistik
- **Achievement Gallery**: Showcase prestasi organisasi
- **History Page**: Sejarah ELITE
- **Profile Management**: Upload foto profil, edit data
- **Session Management**: Keamanan berbasis session PHP

## 🛠️ Teknologi yang Digunakan

### Backend
- **PHP** (Native/Prosedural)
- **MySQL** (Database)
- **mPDF v8.0.3** (PDF Generation)
- **FPDI** (PDF Template)

### Frontend
- **HTML5/CSS3**
- **Bootstrap 5** (Responsive Framework)
- **JavaScript/jQuery**
- **SweetAlert2** (Alert Dialog)
- **AOS** (Animate On Scroll)
- **CKEditor** (Rich Text Editor untuk posting)

### Libraries & Dependencies
- **Composer** (PHP Dependency Manager)
- **PSR Log** (Logging Interface)
- **Boxicons** (Icon Library)
- **GLightbox** (Lightbox Gallery)
- **PureCounter** (Counter Animation)

## 📁 Struktur Proyek

```
elite1010/
├── assets/                    # Asset statis (css, js, img)
│   ├── css/
│   ├── js/
│   ├── img/
│   └── vendor/               # Frontend libraries
├── dashboard/                 # Dashboard area (role-based)
│   ├── admin-page/           # Admin dashboard
│   │   ├── function/         # Backend logic
│   │   └── vendor/           # CKEditor
│   ├── inventaris-page/      # Inventaris dashboard
│   ├── bendahara-page/       # Bendahara dashboard
│   ├── member-page/          # Member dashboard
│   ├── alumni-page/          # Alumni dashboard
│   └── template/             # Shared templates
├── koneksi/                  # Database & helpers
│   ├── conn.php             # Database connection
│   ├── function/            # Shared functions
│   └── template/            # Public templates
├── login/                    # Login page
├── register/                 # Registration page
├── profile/                  # User profile images
├── imgpost/                  # Post images
├── mpdf_v8.0.3-master/      # PDF library
├── vendor/                   # Composer dependencies
├── index.php                # Landing page
├── cek_login.php            # Login handler
├── function.php             # Global functions
└── composer.json            # Composer config
```

## 🚀 Instalasi

### Prerequisites
- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Apache/Nginx** Web Server
- **Composer** (Optional, untuk dependency management)

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd elite1010
   ```

2. **Setup Database**
   - Buat database baru di MySQL:
     ```sql
     CREATE DATABASE db_elite;
     ```
   - Import struktur database (jika ada file SQL)
   - Atau buat tabel manual sesuai struktur di `koneksi/conn.php`

3. **Konfigurasi Database**

   Edit file `koneksi/conn.php`:
   ```php
   $conn = mysqli_connect("localhost", "root", "", "db_elite");
   ```

   Sesuaikan:
   - Host: `localhost`
   - Username: `root`
   - Password: (kosongkan jika default)
   - Database: `db_elite`

4. **Install Dependencies (Optional)**
   ```bash
   composer install
   ```

5. **Set Permissions**
   ```bash
   chmod 755 profile/
   chmod 755 imgpost/
   chmod 755 dashboard/inventaris-page/foto_item/
   ```

6. **Akses Aplikasi**

   Buka browser dan akses:
   ```
   http://localhost/elite1010/
   ```

## 📱 Penggunaan

### Login
1. Akses halaman login: `http://localhost/elite1010/login/`
2. Gunakan kredensial sesuai role
3. Sistem akan redirect ke dashboard sesuai role

### Registrasi
1. Akses: `http://localhost/elite1010/register/`
2. Isi form pendaftaran:
   - Nama Lengkap
   - Kelas
   - Email
   - Password (min 8 karakter)
   - Upload foto profil
3. Status awal: **Pending (Role 6)**
4. Menunggu approval dari Admin

### Dashboard Admin
- **User Management**: Verifikasi, edit, hapus user
- **Class Management**: Kelola data kelas
- **Post Management**: Buat pengumuman/achievement
- **Reports**: Akses semua laporan

### Dashboard Inventaris
- **Barang**: CRUD barang inventaris
- **Peminjaman**: Approve/reject peminjaman
- **Laporan**: Generate PDF laporan inventaris

### Dashboard Bendahara
- **Kas Masuk**: Input pemasukan per siswa
- **Kas Keluar**: Input pengeluaran organisasi
- **Laporan**: Generate PDF laporan kas

### Dashboard Member/Alumni
- **Inventory**: Browse dan pinjam barang
- **Cart**: Kelola keranjang peminjaman
- **History**: Lihat riwayat peminjaman

## 🔒 Keamanan

- **Password Hashing**: Menggunakan `password_hash()` dan `password_verify()`
- **Session Management**: Validasi session per role
- **SQL Injection**: (⚠️ **Warning**: Gunakan prepared statements)
- **File Upload Validation**: Validasi tipe file untuk foto

### Rekomendasi Keamanan
⚠️ **Penting untuk Production**:
1. Gunakan **Prepared Statements** untuk query database
2. Implementasi **CSRF Token** untuk form
3. Tambahkan **input validation & sanitization**
4. Gunakan **HTTPS** untuk production
5. Set **secure session cookies**

## 📊 Struktur Database

### Tabel Utama
- `tb_user` - Data user & credentials
- `tb_role` - Role/level user
- `tb_kelas` - Data kelas
- `tb_inventory` - Data barang inventaris
- `tb_kategori_barang` - Kategori barang
- `tb_peminjaman` - Header peminjaman
- `tb_peminjaman_detail` - Detail peminjaman
- `tb_kas_siswa` - Kas pemasukan siswa
- `tb_kas_keluar` - Kas pengeluaran
- `tb_post` - Posting/pengumuman
- `tb_kategori` - Kategori post

### Relasi Kunci
```
tb_user (id_user) ← tb_peminjaman (id_user)
tb_peminjaman (id_peminjaman) ← tb_peminjaman_detail (id_peminjaman)
tb_inventory (id_barang) ← tb_peminjaman_detail (id_barang)
tb_user (id_role) → tb_role (id_role)
tb_user (id_kelas) → tb_kelas (id_kelas)
```

## 🎨 User Interface

### Landing Page
- Hero section dengan video showcase
- Counter statistik (Siswa, Juara, Alumni)
- About section
- Responsive design

### Dashboard Layout
- **Sidebar Navigation**: Menu sesuai role
- **Top Navbar**: Profile, logout
- **Content Area**: Dynamic content
- **Alert System**: SweetAlert2 notifications

### Responsive Design
- Mobile-friendly layout
- Bootstrap grid system
- Touch-optimized untuk mobile

## 📝 Workflow Sistem

### Workflow Pendaftaran
```
User Register → Status: Pending (Role 6)
       ↓
Admin Review → Terima/Tolak
       ↓
Terima → Role aktif (4/Member)
Tolak → Role 7 (Ditolak)
```

### Workflow Peminjaman
```
Member → Pilih Barang → Add to Cart
       ↓
Checkout → Status: Pending
       ↓
Inventaris Review → Approve/Reject
       ↓
Approve → Status: Dipinjam
       ↓
Return → Status: Dikembalikan
```

### Workflow Kas
```
Bendahara → Input Pemasukan (per siswa)
         → Input Pengeluaran
       ↓
Sistem kalkulasi Saldo
       ↓
Generate Laporan PDF
```

## 🐛 Troubleshooting

### Error Database Connection
```
Error: mysqli_connect(): (HY000/1045): Access denied
```
**Solusi**: Periksa kredensial di `koneksi/conn.php`

### Error Permission Denied (Upload)
```
Warning: move_uploaded_file(): failed to open stream
```
**Solusi**:
```bash
chmod -R 755 profile/ imgpost/
```

### Error mPDF
```
Fatal error: Class 'Mpdf\Mpdf' not found
```
**Solusi**:
```bash
composer require mpdf/mpdf
```

## 🤝 Kontribusi

ELITE adalah proyek internal SMKN 2 Surabaya. Untuk kontribusi:

1. Fork repository
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📄 License

Project ini dibuat untuk keperluan internal ekstrakurikuler robotika SMKN 2 Surabaya.

## 👥 Tim Pengembang

**ELITE - Electronic Innovation Center**
Ekstrakurikuler Robotika SMKN 2 Surabaya

## 📞 Kontak

- **Website**: [SMKN 2 Surabaya](https://www.smkn2-sby.sch.id)
- **Location**: SMK Negeri 2 Surabaya
- **Email**: Contact via website

## 🔄 Changelog

### Version 1.0.0 (Current)
- ✅ Multi-role authentication system
- ✅ Inventory management with cart system
- ✅ Financial management (kas masuk/keluar)
- ✅ PDF report generation
- ✅ User registration with approval workflow
- ✅ Post/announcement system
- ✅ Responsive landing page

### Planned Features
- [ ] Email notification system
- [ ] Advanced search & filter
- [ ] Export to Excel
- [ ] Dashboard analytics & charts
- [ ] QR Code untuk peminjaman
- [ ] Mobile app integration

## 📚 Dokumentasi Teknis

### API Endpoints (Internal)
- `/cek_login.php` - Login handler
- `/register/daftar.php` - Registration handler
- `/dashboard/*/function/*.php` - CRUD operations

### Session Variables
```php
$_SESSION['login'] = [
    'id_user' => int,
    'nama_lengkap' => string,
    'email' => string,
    'id_role' => string,
    'id_kelas' => int,
    'image_profile' => string
];
```

### Role IDs
- `1` = Admin
- `2` = Inventaris
- `3` = Bendahara
- `4` = Member/Siswa
- `5` = Alumni
- `6` = Pending (Menunggu approval)
- `7` = Rejected (Ditolak)

---

**Dibuat dengan ❤️ oleh Tim ELITE - SMKN 2 Surabaya**

*"Electronic Innovation Center - Innovate, Create, Compete"*
