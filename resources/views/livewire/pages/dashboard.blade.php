{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php 

?>
@extends('layouts.unauthorized')
@section('content')
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex justify-between">
            <div class="order-first">
                <h1 class="text-2xl font-bold p-2 text-white leading-tight">
                    Dashboard
                </h1>
            </div>
            
            <div class="order-last">
                <a href="#transaksi/baru" class="font-bold p-2 text-white leading-tight">
                    <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                </a>
            </div>
        </div>
    </div>

    <div class="p-2 static">
        <h2 class="text-black text-xl font-bold">Selamat Datang, {{ $user }}</h2>
        
        {{-- contoh data yang akan ditampilkan --}}
        {{-- 
            
        --}}

        <div class="mt-3 mb-3">
            <x-item-list vartoclick="x()">
                <p>Siomayku</p>
                <p>1 Oktober 2024 12:15:10</p>
                <p>by Ari</p>
            </x-item-list>

            <x-item-list vartoclick="x()">
                <p>Baksoku</p>
                <p>30 September 2024 13:15:10</p>
                <p>by Ari</p>
            </x-item-list>
            {{-- ? Disini menampilkan daftar 10 item list transaksi terbaru dari semua UMKM.  --}}
        </div>
        {{-- <a href="#transaksi/baru" class="inline-flex items-center p-4 m-3 bg-sky-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 focus:bg-sky-500 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 fixed bottom-0 right-0">
            <ion-icon name="add-outline" size="large"></ion-icon>
        </a> --}}
    </div>
</div>
<x-navbottom/>
@endsection