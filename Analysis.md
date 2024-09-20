# Analysis
1. User mengakses situs : localhost/public/login
2. Sistem redirect User dan menampilkan halaman "Login".

Di halaman "Login" : tombol "Daftar" dan "Masuk".
3. User mengisi form "Login" kemudian klik tombol "Masuk".
4. Sistem mengecek ketersediaan username/email dan passwordnya.
    4.1. Jika username/email tidak tersedia, maka sistem menampilkan notif : "Username/Email Tidak Tersedia!".
    4.2. Jika password salah, maka sistem menampilkan notif : "Password Salah!".
    4.3. Jika username/email dan password tersedia dan benar, maka sistem redirect User ke halaman "Dashboard".

5. User klik tombol "Daftar", sistem redirect User ke halaman "Daftar Pengguna Baru".

Di halaman "Daftar Pengguna Baru", terdapat tombol : "Simpan" dan "<- (Kembali)".
6. User mengisi form "Daftar Pengguna Baru" kemudian klik "Simpan".
7. Sistem mengecek ketersediaan username dan email.
     4.1. Jika username/email tersedia, maka sistem menampilkan notif : "Username/Email Sudah Terdaftar!".
     4.2. Jika username/email tidak tersedia, maka sistem menampilkan notif : "Data Pengguna Baru Tersimpan!", ketika User klik tombol "OK" sistem redirect User ke halaman "Login" atau jika dibiarkan/dianggurin maka sistem redirect User ke halaman "Login".

Terdapat menu navigasi :
- Dashboard.
- UMKMKU. => Hanya bisa diakses oleh Direktur, Manager.
- Transaksi. => Hanya bisa diakses oleh non Direktur/Manager.
- Profil.
- Logout, sistem mengeluarkan User dari sistem dan redirect User ke halaman "Login".

Di halaman "Dashboard" :
- Sistem menampilkan daftar 10 item list transaksi terbaru dari semua UMKM.
- Disediakan tombol cepat untuk transaksi baru, dimana sistem redirect User ke halaman "Transaksi Baru".

Di halaman "UMKMKU"
- Sistem menampilkan daftar semua item list UMKM berdasarkan abjad atau tanggal berdiri. => item list di klik, sistem redirect User ke halaman detail "UMKM"
- Disediakan tombol untuk menambahkan UMKM baru, dimana sistem redirect User ke halaman "UMKM Baru".

Di halaman detail "UMKM" : 
- Nama UMKM
- Tanggal Berdiri
- Jenis Usaha
- Deskripsi
- Logo
- Foto
- Alamat beserta longitude dan latitude.
- No. Telepon

Terdapat 3 Tab :
1. Produk :
    - Sistem menampilkan item list produk berdasarkan abjad atau rekomendasi. => item list di klik, sistem redirect User ke halaman detail produk.
    - Disediakan tombol untuk menambahkan produk baru, dimana sistem redirect User ke halaman "Produk Baru".
2. Transaksi
    - Sistem menampilkan item list produk berdasarkan abjad atau rekomendasi. => item list di klik, sistem redirect User ke halaman detail transaksi.
    - Disediakan tombol untuk menambahkan transaksi baru, dimana sistem redirect User ke halaman "Transaksi Baru".
    - Disediakan sebuah fungsi untuk review transaksi berdasarkan tanggal tertentu atau perharian, permingguan, perbulanan, dan pertahunan.
3. Pegawai
    - Sistem menampilkan item list produk berdasarkan abjad atau rekomendasi. => item list di klik, sistem redirect User ke halaman detail pegawai.
    - Disediakan tombol untuk menambahkan pegawai baru, dimana sistem redirect User ke halaman "Pegawai Baru".

Di halaman detail "Produk" :
- Nama
- Merk
- Jenis
- Deskripsi
- Harga
- Stok
- Satuan
- Diskon

Di halaman detail "Pegawai" :
- Nama
- Email
- Username
- No. Telpon
- Jenis Kelamin
- Alamat
- Foto
- Tempat, Tanggal Lahir
- Penempatan UMKM
- Status => Aktif, Tidak Aktif.
- Jabatan => Direktur, Manager, HRD, Senior, Junior.

Di halaman detail "Transaksi" :
- Nama UMKM beserta Alamatnya.
- Tanggal Transaksi Tercatat.
- Siapa yang menginput data transaksinya.
- Detail informasi produk yang dibeli.
- Total Belanja
- Uang yang diterima.
- Uang kembalian = Uang yang diterima - Total Belanja.

Ada 3 fitur :
- Share nota digital.
- Print
- Export ke file PDF.

Di halaman "Profil" :
- Username
- Nama
- Email
- No. Telpon
- Jenis Kelamin
- Alamat
- Foto
- Tempat, Tanggal Lahir
- Penempatan UMKM
- Status => Aktif, Tidak Aktif.
- Jabatan => Direktur, Manager, HRD, Senior, Junior.

User bisa update data informasi diri, kecuali username dan email.

# Copyright @ Syahri Ramadhan Wiraasmara (ARI)
link github : https://github.com/ariwiraasmara/umkmku