{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
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
                @if($id_umkm != null || !is_null($id_umkm)) 
                    <a href="{{ '/transaksi/baru/'.$id_umkm }}" class="font-bold p-2 text-white leading-tight">
                        <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                    </a>
                @else
                    <a href="{{ '/transaksi/baru/0' }}" class="font-bold p-2 text-white leading-tight">
                        <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                    </a>
                @endif

                
            </div>
        </div>
    </div>

    <div class="p-3 ml-2 static" style="margin-bottom: 50px;">
        <h2 class="text-black text-xl font-bold">
            Selamat Datang, 
            
            @if( $id_umkm == null || empty($id_umkm) || is_null($id_umkm) || $id_umkm == '' )
                @if($jk == 'Pria')
                    Bapak 
                @else
                    Ibu 
                @endif
                Direktur
            @endif
            
            @if( $nama == null || empty($nama) || is_null($nama) || $nama == '' ) 
                {{ $username }}
            @else
                {{ $nama }}
            @endif
        </h2>
        
        <div class="mt-3">
            @if ($data_transaksi)
                @foreach ($data_transaksi as $dt)
                    <div class="border-b border-gray-600 p-2">
                        <a href="{{ '/transaksi/detil/'.$dt->id_transaksi }}">
                            <p>
                                @if($roles < 3)
                                    <span class="font-bold">
                                        {{ $dt->nama_umkm }}
                                    </span>,
                                @endif
                                {{ $dt->tgl }}
                            </p>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <h1 class="font-bold text-2xl py-2 mb-2 border-b">
                        Data Transaksi Kosong
                    </h1>
                </div>
            @endif
        </div>
    </div>
    <x-navbottom/>
</div>