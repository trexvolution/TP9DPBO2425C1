# TP9 DPBO Implementasi MVP

# Janji

Saya Nur Abdillah Ifhamuddin dengan NIM 2408515 mengerjakan Tugas Praktikum 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Database

A. Tabel pembalap

Digunakan untuk menyimpan data atlet balapan.

- id (INT, PK, Auto Increment): Identitas unik pembalap.
- nama (VARCHAR): Nama lengkap pembalap.
- tim (VARCHAR): Nama tim balap (misal: Red Bull, Ferrari).
- negara (VARCHAR): Asal negara pembalap.
- poinMusim (INT): Total poin yang dikumpulkan musim ini.
- jumlahMenang (INT): Jumlah kemenangan podium 1.

B. Tabel sirkuit

Digunakan untuk menyimpan data lokasi balapan (Entitas Tambahan).

- id (INT, PK, Auto Increment): Identitas unik sirkuit.
- nama (VARCHAR): Nama sirkuit (misal: Mandalika).
- negara (VARCHAR): Lokasi negara sirkuit.
- panjang_km (FLOAT atau DECIMAL): Panjang lintasan dalam kilometer.
- jumlah_tikungan (INT): Total tikungan di sirkuit tersebut.

# Konsep Arsitektur MVP (Model-View-Presenter)
Program ini memisahkan logika aplikasi menjadi tiga komponen utama untuk memudahkan pemeliharaan dan pengembangan tim.

M - Model

Tugas: Bertanggung jawab mengelola data dan logika bisnis (akses database). Model tidak tahu apa-apa tentang tampilan (HTML).

File: Pembalap.php (Objek Data), Sirkuit.php (Objek Data), TabelPembalap.php (Query SQL), TabelSirkuit.php (Query SQL), DB.php (Koneksi Database).

Contoh: Ketika data dibutuhkan, Model akan menjalankan SELECT * FROM ... dan mengembalikannya sebagai array objek.

V - View

Tugas: Bertanggung jawab menampilkan data ke layar pengguna (User Interface). View tidak boleh melakukan olah data atau akses database langsung.

File: ViewPembalap.php, ViewSirkuit.php, skin.html, form.html.

Contoh: Menerima data dari Presenter, lalu memasukkannya ke dalam tabel HTML (skin.html) untuk dilihat pengguna.

P - Presenter

Tugas: Perantara (jembatan) antara Model dan View. Ia mengambil data dari Model, lalu menyerahkannya ke View. Ia juga menangani input dari pengguna (seperti tombol simpan/hapus).

File: PresenterPembalap.php, PresenterSirkuit.php.

Contoh: Presenter diperintah oleh index.php untuk "Tampilkan Data", maka Presenter meminta data ke Model, lalu hasilnya dikirim ke View.

# Direktori File

<img width="657" height="597" alt="Direktori" src="https://github.com/user-attachments/assets/7d71a4e1-2710-40a9-b216-17a770bfd4d5" />

# Alur Kerja Program (Workflow)
## Skenario 1: Menampilkan Daftar Data (READ)
User membuka index.php?modul=pembalap.

Index.php membaca parameter modul, lalu menginstansiasi Model, View, dan Presenter yang sesuai.

Index.php memanggil method presenter->tampilkanPembalap().

Presenter meminta data ke Model (getAllPembalap).

Model melakukan query SELECT ke Database dan mengembalikan hasilnya ke Presenter.

Presenter memberikan data tersebut ke View.

View memuat template skin.html, mengganti placeholder DATA_TABEL dengan baris data, lalu mengembalikan HTML utuh.

User melihat tabel data di browser.

## Skenario 2: Menambah Data Baru (CREATE)
User klik tombol "Tambah", diarahkan ke index.php?modul=pembalap&screen=add.

Presenter memanggil view->tampilFormPembalap().

View memuat form.html, mengisi id="action" dengan value "add".

User mengisi form dan klik "Simpan" (Submit POST).

Index.php mendeteksi adanya request $_POST['action'] == 'add'.

Index.php memanggil presenter->tambahPembalap(...).

Presenter meneruskan data ke Model.

Model melakukan query INSERT INTO ....

Program me-redirect kembali ke halaman utama (Skenario 1).

Skenario 3: Mengubah & Menghapus (UPDATE & DELETE)
Edit: Mirip dengan Create, tapi saat form ditampilkan, View akan mengisi kolom input (value="...") dengan data lama yang diambil berdasarkan ID. Action form diubah menjadi "edit".

Delete: Dilakukan via Form POST (tombol hapus). Index.php menangkap action == delete, lalu memerintahkan Presenter untuk memanggil Model agar menjalankan query DELETE FROM ....

# Dokumentasi

https://github.com/user-attachments/assets/4f703331-3c35-4445-8959-4e56c1e7780b

