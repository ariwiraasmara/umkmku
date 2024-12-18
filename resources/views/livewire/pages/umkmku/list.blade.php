{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php
use App\Libraries\myfunction;
?>
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex justify-between">
            <div class="order-first">
                <h1 class="text-2xl font-bold p-2 text-white leading-tight">
                    {{ $title }}
                </h1>
            </div>
            
            <div class="order-last">
                <a href="/umkmku/baru" class="font-bold p-2 text-white leading-tight">
                    <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                </a>
            </div>
        </div>
    </div>

    <div class="py-6 px-6 static" style="margin-bottom: 60px;">
        @if ($data != null && gettype($data) != 'string')
            @foreach ($data as $dt)
                <a href="{{ '/umkmku/detil/'. $dt->id_umkm }}">
                    <p class="py-2 mb-2 border-b">{{ $dt->nama_umkm }}</p>
                </a>
            @endforeach
        @endif
        {{-- ? Disini menampilkan daftar item list umkm yang dimiliki.  --}}
    </div>
    <x-navbottom/>
</div>