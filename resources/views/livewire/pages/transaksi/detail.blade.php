{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php

?>
@extends('layouts.unauthorized')
@section('content')
{{-- - Nama UMKM beserta Alamatnya.
- Tanggal Transaksi Tercatat.
- Siapa yang menginput data transaksinya.
- Detail informasi produk yang dibeli.
- Total Belanja
- Uang yang diterima.
- Uang kembalian = Uang yang diterima - Total Belanja. --}}

<div class="flex flex-col static items-center justify-center p-2 border-b">
    {{-- <img src="" /> --}}
    <ion-icon name="logo-youtube"></ion-icon>
    <h1 class="text-2xl font-bold text-black leading-tight mt-2">[Nama UMKM]</h1>
    <p class="font-bold text-black leading-tight mt-2">
        [Alamat]
    </p>
    <p class="font-bold text-black underline-offset-1 leading-tight mt-2">
        Telp : [No. Telepon]
    </p>
</div>

<div class="static border-b p-2">
    <table class="auto text-left">
        <tbody>
            <tr>
                <td class="font-bold">No. Transaksi</td>
                <td>:</td>
                <td>[No. Transaksi]</td>
            </tr>

            <tr>
                <td class="font-bold">Tanggal</td>
                <td>:</td>
                <td>[Tanggal]</td>
            </tr>

            <tr>
                <td class="font-bold">Kasir</th>
                <td>:</th>
                <td>[Kasir]</td>
            </tr>

            <tr>
                <td class="font-bold">Pelanggan</td>
                <td>:</th>
                <td>[Pelanggan]</th>
            </tr>
        </tbody>
    </table>
</div>

<div class="p-2 static border-b">
    {{-- 
    // detailtransaksi1 | fulan | 2024-09-28 | fulani | Bakso Kikil | Warung Fulan | 10000 | 0 | 1 | porsi | 0 | 1000 | 9000 |
    // detailtransaksi2 | fulan | 2024-09-28 | fulani | Bakso Daging | Warung Fulan | 12000 | 2000 | 1 | porsi | 0 | 10000 |
    // detailtransaksi3 | fulan | 2024-09-28 | fulano | Bakso Ikan | Warung Fulan | 15000 | 2000 | 3 | porsi | 1000 | 39000 | 
    --}}

    <div>
        <p><span class="font-bold">Bakso Kikil,</span> 1 porsi</p>
        <div class="flex flex-row justify-between">
            <div class="order-first">
                Rp. 10.000 x 1
            </div>
            <div class="order-last">
                10.000
            </div>
        </div>
    </div>

    <div>
        <p><span class="font-bold">Bakso Kikil,</span> 3 porsi</p>
        <div class="flex flex-row justify-between">
            <div class="order-first">
                Rp. 1.000.000 x 3 - <span class="italic">(dis.) 1.000.000</span>
            </div>
            <div class="order-last">
                2.000.000
            </div>
        </div>
    </div>
</div>

<div class="p-2 static border-b">
    <div class="flex flex-row justify-between">
        <div class="order-first">
            Sub Total Produk
        </div>
        <div class="order-last">
            2.010.000
        </div>
    </div>

    <div class="flex flex-row justify-between">
        <div class="order-first">
            Diskon
        </div>
        <div class="order-last">
            500.000
        </div>
    </div>
</div>

<div class="p-2 static border-b">
    <div class="flex flex-row justify-between">
        <div class="order-first font-bold text-lg">
            Total
        </div>
        <div class="order-last">
            1.510.000
        </div>
    </div>

    <div class="flex flex-row justify-between">
        <div class="order-first font-bold text-lg">
            Dibayar
        </div>
        <div class="order-last">
            2.050.000
        </div>
    </div>

    <div class="flex flex-row justify-between">
        <div class="order-first font-bold text-lg">
            Kembalian
        </div>
        <div class="order-last">
            540.000
        </div>
    </div>
</div>

<div class="p-2 static mb-3">
    <div class="flex flex-row items-center justify-center gap-4">
        <div class="underline text-blue" onclick="shareNota()">
            Share
        </div>

        <div class="underline text-blue" onclick="printNota()">
            Print
        </div>

        <div class="underline text-blue" onclick="exportToPDF()">
            Export
        </div>
    </div>
</div>
@endsection