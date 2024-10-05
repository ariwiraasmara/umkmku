{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
{{-- @extends('layouts.authorized')
@section('content') --}}
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
                    {{ $title }}
                </h1>
            </div>

            <div class="order-last text-white">
                <a href="{{ '/umkmku/edit/'.$id_umkm }}" style="margin-right: 20px;">
                    <ion-icon name="pencil-outline" size="large" style="margin-top: 5px;"></ion-icon>
                </a>

                <a href="{{ '/process/umkm/delete/'.$id_umkm }}">
                    <ion-icon name="trash-outline" size="large" style="margin-top: 5px;"></ion-icon>
                </a>
                
            </div>
        </div>
    </div>

    <div class="p-2 static">
        <p><span class="font-bold">Tanggal Berdiri : </span> {{ $tgl_berdiri }}</p>
        <p><span class="font-bold">Jenis Usaha : </span> {{ $jenis_usaha }}</p>
        <p><span class="font-bold">Deskripsi : </span> {{ $deskripsi }}</p>
        <p><span class="font-bold">Alamat : </span> {{ $alamat.', '.$longitude.', '.$latitude }}</p>
        <p><span class="font-bold">No. Telepon : </span> {{ $no_tlp }}</p>
        <p><span class="font-bold">Foto : </span> {{ $foto_umkm }}</p>
        <p><span class="font-bold">Logo : </span> {{ $logo_umkm }} </p>
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
            <a href="{{ '/produk/baru/'.$id_umkm }}">
                <div class="w-full text-center">
                    <ion-icon name="add-outline" size="large"></ion-icon>
                </div>
            </a>

            {{--
            @if ($data_produk->getData()->data != 0)
                @foreach ($data_produk->getData()->data as $dt)
                    <a href="{{ '/umkmku/detil/'. $dt->id_produk }}">
                        <p class="py-2 mb-2 border-b">{{ $dt->nama }}</p>
                    </a>
                @endforeach
            @else
                <a href="{{ '/umkmku/detil/#' }}">
                    <p class="py-2 mb-2 border-b">Data Produk Kosong</p>
                </a>
            @endif
            --}}
        </div>

        <div id="tab2" class="hidden p-4 bg-white border-t border-gray-200 static">
            <a href="{{ '/transaksi/baru/'.$id_umkm }}">
                <div class="w-full text-center border-b border-gray-600">
                    <ion-icon name="add-outline" size="large"></ion-icon>
                </div>
            </a>

            {{-- {{ var_dump($data_transaksi) }} --}}
            
            {{-- <livewire:pages.transaksi.list_in_umkm :id_transaksi="$dt->id_transaksi" /> --}}
                    {{-- @include('livewire.pages.transaksi.list_in_umkm') --}}
                    {{-- @livewire('pages.transaksi.list_in_umkm', [
                        'id_transaksi' => $dt->id_transaksi, 
                        'tgl' => $dt->tgl
                    ]) 
            --}}

            @if ($data_transaksi)
                @foreach ($data_transaksi as $dt)
                    

                    <div class="static mt-3 flex flex-row justify-between border-b border-gray-600">
                        <div class="order-first">
                            <a href="{{ 'transaksi/detil/'.$dt->id_transaksi }}">
                                <p>{{ $dt->tgl }}</p>
                            </a>
                        </div>
                        <div class="order-last text-white">
                            <a href="{{ 'transaksi/hapus/'.$dt->id_transaksi }}">
                                <ion-icon name="trash-outline" size="large" style="margin-top: 5px;"></ion-icon>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <a href="#">
                    <p class="py-2 mb-2 border-b">Data Transaksi Kosong</p>
                </a>
            @endif
        </div>

        <div id="tab3" class="hidden p-4 bg-white border-t border-gray-200 static">
            <a href="{{ '/staff/baru/'.$id_umkm }}">
                <div class="w-full text-center">
                    <ion-icon name="add-outline" size="large"></ion-icon>
                </div>
            </a>

            {{-- <x-item-list vartoclick="x()">
                <p>Syahri Ramadhan Wiraasmara</p>
                <p>ariwiraasmara.sc37@gmail.com</p>
            </x-item-list> --}}
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
</div>       
{{-- @endsection --}}