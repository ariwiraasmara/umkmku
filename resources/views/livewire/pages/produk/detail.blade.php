{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php
use App\Libraries\myfunction;
?>
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex">
            <div class="">
                <a href="{{ '/umkmku/detil/'.myfunction::enval($id_umkm) }}" class="font-bold p-2 text-white leading-tight">
                    <ion-icon name="arrow-back-outline" style="font-size: 30px; margin-top:8px;"></ion-icon>
                </a>
            </div>

            <div class="">
                <h1 class="text-2xl font-bold p-2 text-white leading-tight">
                    {{ $title }}
                </h1>
            </div>
        </div>
    </div>

    <div class="py-4 px-4 static">
        <p><span class="font-bold">Nama :</span>{{ $data[0]['nama'] }}</p>
        <p><span class="font-bold">Merk :</span>{{ $data[0]['merk'] }}</p>
        <p><span class="font-bold">Jenis :</span>{{ $data[0]['jenis'] }}</p>
        <p><span class="font-bold">Deskripsi :</span>{{ $data[0]['deskripsi'] }}</p>
        <p><span class="font-bold">Harga :</span>{{ $data[0]['harga'] }}</p>
        <p><span class="font-bold">Stok :</span>{{ $data[0]['stok'] }}</p>
        <p><span class="font-bold">Satuan Unit :</span>{{ $data[0]['satuan_unit'] }}</p>
        <p><span class="font-bold">Diskon :</span>{{ $data[0]['diskon'] }}</p>
    </div>

    <div class="flex items-center justify-center mt-3">
        <div class="flex-initial w-50">
            <a href="{{ '/produk/edit/'.myfunction::enval($data[0]['id_produk']).'/'.$id_umkm.'/e' }}" style="margin-right: 20px;">
                <x-secondary-button class="ms-3 text-center">
                    <ion-icon name="pencil-outline" size="large" style="margin-top: 5px;"></ion-icon>
                </x-secondary-button>
            </a>
        </div>
        
        <div class="flex-initial w-50">
            <a href="{{ '/process/produk/delete/'.myfunction::enval($data[0]['id_produk']).'/'.$id_umkm }}">
                <x-secondary-button class="ms-3 text-center">
                    <ion-icon name="trash-outline" size="large" style="margin-top: 5px;"></ion-icon>
                </x-secondary-button>
            </a>
        </div>
    </div>
</div>