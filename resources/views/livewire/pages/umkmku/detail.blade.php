{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php 

?>
@extends('layouts.unauthorized')
@section('content')
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex justify-between">
            <div class="order-first">
                <a href="/umkmku" class="font-bold p-2 text-white leading-tight">
                    <ion-icon name="arrow-back-outline" style="font-size: 30px; margin-top:8px;"></ion-icon>
                </a>
            </div>

            <div class="order-first">
                <h1 class="text-2xl font-bold p-2 text-white leading-tight">
                    [Nama UMKM]
                </h1>
            </div>

            <div class="order-last text-white">
                <ion-icon name="trash-outline" size="large" style="margin-top: 5px;"></ion-icon>
            </div>
        </div>
    </div>

    <div class="p-2 static">
        <p><span class="font-bold">Tanggal Berdiri : </span> [Tanggal Berdiri]</p>
        <p><span class="font-bold">Jenis Usaha : </span> [Jenis Usaha]</p>
        <p><span class="font-bold">Deskripsi : </span> [Deskripsi]</p>
        <p><span class="font-bold">Alamat : </span> [Alamat beserta longitude dan latitude.]</p>
        <p><span class="font-bold">No. Telepon : </span> [No. Telepon]</p>
        <p><span class="font-bold">Foto : </span> [Foto]</p>
        <p><span class="font-bold">Logo : </span> [Logo]</p>
    </div>

    <div class="p2 mt-3 mb-3 static w-full">
        <nav class="flex flex-row">
            <div class="basis-1/4 flex-1">
                <button class="w-full text-white px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-t-lg md:rounded-l-lg md:rounded-tr-none" onclick="openTab('tab1')">
                    <ion-icon name="fast-food-outline" size="large"></ion-icon> <br/>
                    Produk
                </button>
            </div>

            <div class="basis-1/4 flex-1">
                <button class="w-full text-white px-4 py-2 bg-gray-500 hover:bg-gray-700" onclick="openTab('tab2')">
                    <ion-icon name="cash-outline" size="large"></ion-icon> <br/>
                    Transaksi
                </button>
            </div>

            <div class="basis-1/4 flex-1">
                <button class="w-full text-white px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-t-lg md:rounded-r-lg md:rounded-tl-none" onclick="openTab('tab3')">
                    <ion-icon name="people-outline" size="large"></ion-icon> <br/>
                    Pegawai
                </button>
            </div>
        </nav>
      
        <div id="tab1" class="p-4 bg-white border-t border-gray-200 static">
            <x-item-list vartoclick="x()">
                Produk 1
            </x-item-list>

            <x-item-list vartoclick="x()">
                Produk 2
            </x-item-list>

            <x-item-list vartoclick="x()">
                Produk 3
            </x-item-list>

            <x-item-list vartoclick="x()">
                Produk 4
            </x-item-list>

            <x-item-list vartoclick="x()">
                Produk 5
            </x-item-list>

            {{-- <a href="#produk/baru" class="inline-flex items-center p-4 m-3 bg-sky-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 focus:bg-sky-500 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 fixed bottom-0 right-0">
                <ion-icon name="add-outline" size="large"></ion-icon>
            </a> --}}
        </div>

        <div id="tab2" class="hidden p-4 bg-white border-t border-gray-200 static">
            <x-item-list vartoclick="openModal(11, 'Siomayku', '1 Oktober 2024 12:15:10', 'Ari')">
                <p>1 Oktober 2024 12:15:10</p>
                <p>by Ari</p>
            </x-item-list>

            <x-item-list vartoclick="openModal(11, 'Siomayku', '1 Oktober 2024 12:15:10', 'Ari')">
                <p>1 Oktober 2024 12:15:10</p>
                <p>by Ari</p>
            </x-item-list>

            <x-item-list vartoclick="openModal(11, 'Siomayku', '1 Oktober 2024 12:15:10', 'Ari')">
                <p>1 Oktober 2024 12:15:10</p>
                <p>by Ari</p>
            </x-item-list>

            <x-item-list vartoclick="openModal(11, 'Siomayku', '1 Oktober 2024 12:15:10', 'Ari')">
                <p>1 Oktober 2024 12:15:10</p>
                <p>by Ari</p>
            </x-item-list>

            <x-item-list vartoclick="openModal(11, 'Siomayku', '1 Oktober 2024 12:15:10', 'Ari')">
                <p>1 Oktober 2024 12:15:10</p>
                <p>by Ari</p>
            </x-item-list>

            {{-- <a href="#transaksi/baru" class="inline-flex items-center p-4 m-3 bg-sky-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 focus:bg-sky-500 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 fixed bottom-0 right-0">
                <ion-icon name="add-outline" size="large"></ion-icon>
            </a> --}}
        </div>

        <div id="tab3" class="hidden p-4 bg-white border-t border-gray-200 static">
            <x-item-list vartoclick="x()">
                <p>Syahri Ramadhan Wiraasmara</p>
                <p>ariwiraasmara.sc37@gmail.com</p>
            </x-item-list>

            <x-item-list vartoclick="x()">
                <p>Fulan contoh</p>
                <p>fulancontoh@contohmail.com</p>
            </x-item-list>

            {{-- <a href="#user/baru" class="inline-flex items-center p-4 m-3 bg-sky-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 focus:bg-sky-500 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 fixed bottom-0 right-0">
                <ion-icon name="add-outline" size="large"></ion-icon>
            </a> --}}
        </div>
    </div>


</div>

<script>
    function openTab(tabName) {
      var i;
      var x = document.getElementsByClassName("p-4");
      for (i = 0; i < x.length; i++) {
        x[i].classList.add("hidden");
      }
      document.getElementById(tabName).classList.remove("hidden");
    }
</script>          