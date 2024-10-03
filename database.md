create database umkmku;

create table aw1001_user(
   id_user varchar(255) not null primary_key,
   username varchar(255) not null, 
   email varchar(255) not null,
   tlp varchar(20) null,
   password text null,
   roles int not null,
);

create table aw1002_userprofil(
   id_user varchar(255) not null primary_key,
   nama varchar(255) null,
   jk enum('Pria', 'Wanita') null,
   alamat varchar(255) null,
   foto varchar(255) null,
   tempat_lahir varchar(100) null,
   tgl_lahir date null,
   penempatan_umkm varchar(255) null foreign_key,
   status enum('Aktif', 'Tidak Aktif') not null,
   jabatan varchar(255) null
);

create table aw2001_umkmku(
   id_umkm varchar(255) not null primary key,
   id_user varchar(255) not null foreign_key,
   nama_umkm varchar(255) not null,f
   tgl_berdiri date null,
   jenis_usaha varchar(255) not null,
   deskripsi text null,
   logo_umkm text null,
   foto_umkm text null,
   alamat text null,
   longitude big_integer null,
   latitude big_ingteger null,
   no_telp varchar(20) null
);

create table aw3001_produkku(
   id_produk varchar(255) not null primary key,
   id_umkm varchar(255) not null foreign key,
   nama varchar(255) not null,
   merk varchar(255) not null,
   jenis varchar(255) not null,
   deskripsi text null,
   harga int not null,
   stok int not null,
   satuan unit varchar(255) not null,
   diskon double null,
);

create table aw4001_transaksi(
   id_transaksi varchar(255) not null primary key,
   id_umkm varchar(255) not null foreign key,
   tgl date not null,
   id_user varchar(255) not null foreign key,
   diskon double null,
   uang_diterima float not null,
);

create table aw4002_detailtransaksi(
   id_detailtransaksi int(100) not null primary key,
   id_transaksi varchar(255) not null foreign key,
   id_produk varchar(255) not null foreign key,
   jumlah int not null
);