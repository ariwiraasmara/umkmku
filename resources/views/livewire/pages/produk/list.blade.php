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
                    Produk
                </h1>
            </div>
            
            <div class="order-last">
                <a href="#umkm/baru" class="font-bold p-2 text-white leading-tight">
                    <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                </a>
            </div>
        </div>
    </div>


    <div class="p-2 static mb-3">
        <x-item-list>
            <p></p>
        </x-item-list>

        {{-- ? Disini menampilkan daftar item list produk yang dimiliki.  --}}
    </div>
</div>
<x-navbottom/>
@endsection