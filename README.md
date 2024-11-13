# UMKMKU
**Share Link Project** : https://idx.google.com/umkmku-4525957

**Deskripsi :**
UMKMKU adalah sebuah aplikasi berbasis website untuk pelaku usaha UMKM dan digunakan oleh mereka (sebagai user). Aplikasi ini bisa digunakan untuk berbagai jenis umkm dan dapat diakses di berbagai device dan platform.

**Fitur yang diberikan :**
1. User Register
3. User Login
3. User Profil
4. Profil UMKM
5. Informasi pegawai. Baik hanya satu atau lebih dari satu pegawai.
6. Informasi produk.
7. Informasi Transaksi dan detilnya.
8. Informasi Nota berbasis digital maupun bisa di print atau export ke file pdf.
9. Informasi Review Transaksi berdasarkan perharian, permingguan, perbulanan, dan pertahunan.

**Teknologi yang digunakan :**
- GitHub (https://github.com), sebagai repository dan version history.
- MySQL (https://www.mysql.com/), sebagai database.
- Redis (https://redis.io/), sebagai cache.
- Laravel (https://laravel.com/), fullstack. Digunakan sebagai backend (Server as a Service) dan frontend (menggunakan Livewire, Volt, AlpineJS).
- Tailwind (https://tailwindui.com), sebagai UI/UX css.

**Tools yang digunakan :**
- IDX Google (idx.google.com), sebagai IDE.
- Postman (https://www.postman.com/), sebagai API Client.
- Google Gemini, sebagai untuk meningkatkan produktifitas ngoding.

# API References
URL : https://9002-idx-umkmku-1726831788791.cluster-a3grjzek65cxex762e4mwrzl46.cloudworkstations.dev/api

Untuk Akses Token API => **silahkan hubungi saya terlebih dahulu untuk mendapatkannya**

- Route **POST**    `/login`
- Route **POST**    `/daftar-pengguna-baru`
- Route **GET**     `/dashboard`
- Route **GET**     `/profil`
- Route **POST**    `/profil/update`
- Route **POST**    `/profil/update/telpon`
- Route **POST**    `/profil/update/password`
- Route **GET**     `/pegawai/detil/{id}`
- Route **POST**    `/pegawai/baru`
- Route **POST**    `/pegawai/update`
- Route **POST**    `/pegawai/delete/{id}`
- Route **GET**     `/logout`
- Route **GET**     `/umkm/{by}/{orderBy}`
- Route **GET**     `/umkmdetil/{id}`
- Route **POST**    `/umkm/baru`
- Route **POST**    `/umkm/update`
- Route **GET**     `/umkmdelete/{id}`
- Route **GET**     `/produk/{id}`
- Route **GET**     `/produk/detil/{id}`
- Route **POST**    `/produk/baru`
- Route **POST**    `/produk/update`
- Route **GET**     `/produk/delete/{id}`
- Route **GET**     `/transaksi/{id}`
- Route **GET**     `/transaksi/detil/{id}`
- Route **POST**    `/transaksi/baru`
- Route **GET**     `/transaksi/delete/{id}`

# Disclaimer
Sudah ada aplikasi bernama UMKMKU di Google Play dan aplikasi lain berbasis situs milik orang lain. Namun UMKMKU yang satu ini ialah versi saya sendiri, bahkan saya secara pribadi belum pernah menggunakan aplikasi tersebut. Dasar dan ide saya membuat sistem aplikasi ini ialah berdasarkan observasi saya pada lingkungan sekitar dari nota belanja yang pernah saya dapatkan. Tujuannya untuk membuat sistem dan aplikasi versi saya sendiri dan tidak lain ialah untuk konten edukasi serta menambahkannya pada cv saya sendiri.

# Copyright @ Syahri Ramadhan Wiraasmara (ARI)
link github : https://github.com/ariwiraasmara/umkmku