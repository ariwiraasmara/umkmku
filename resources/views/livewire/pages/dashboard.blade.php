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
                    <a href="#" class="font-bold p-2 text-white leading-tight" onclick="openModalShortcutTransaksiDM()">
                        <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="py-6 px-6 static" style="margin-bottom: 50px;">
        {{ $cache }}
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
                        <a href="{{ '/transaksi/detil/'.myfunction::enval($dt->id_transaksi) }}">
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

    @if( $id_umkm == null || $id_umkm == '' || empty($id_umkm) || is_null($id_umkm)) 
        <div id="modalShortcutTransaksiDM" class="modal">
            <div class="modal-content">
                <div class="flex flex-row border-b">
                    <div class="grow w-full static">
                        <div class="inset-x-0 top-0 p-2 flex justify-between">
                            <div class="order-first mt-1">
                                <h1 id="umkm_title" class="text-lg font-bold">Pilih UMKM</h1>
                            </div>
            
                            <div class="order-last">
                                <span class="close" onclick="closeModalShortcutTransaksiDM()">
                                    <ion-icon name="close-circle-outline" size="large"></ion-icon>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($data_umkm != null)
                    @foreach ($data_umkm as $dtu)
                        <a href="{{ '/transaksi/baru/'.myfunction::enval($dtu['id_umkm']) }}">
                            <div class="pb-3 mt-3 border-b">
                                <p>{{ $dtu['nama_umkm'] }}</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal:active {
                display : none;
            }
            
            .modal-content {
                background-color: #fff;
                border-radius: 30px;
                color: #000;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                padding-bottom: 10px;
            }
            
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            
            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>

        <script>
        function openModalShortcutTransaksiDM() {
            document.getElementById("modalShortcutTransaksiDM").style.display = "block";
        }
            
        function closeModalShortcutTransaksiDM() {
            document.getElementById("modalShortcutTransaksiDM").style.display = "none";
        }
        </script>
    @endif

    <x-navbottom/>
</div>