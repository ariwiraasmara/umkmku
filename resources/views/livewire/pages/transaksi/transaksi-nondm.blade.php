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
                <a href="#umkm/baru" class="font-bold p-2 text-white leading-tight">
                    <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                </a>
            </div>
        </div>
    </div>

    <div class="py-6 px-6">
        @if ($data_transaksi)
            @foreach ($data_transaksi as $dt)
                <div class="border-b border-gray-600 p-2">
                    <a href="{{ '/transaksi/detil/'.myfunction::enval($dt->id_transaksi) }}">
                        <p>{{ $dt->tgl }}</p>
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

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="flex flex-row border-b">
                <div class="grow w-full static">
                    <div class="inset-x-0 top-0 p-2 flex justify-between">
                        <div class="order-first mt-1">
                            <h1 id="umkm_title" class="text-lg font-bold">[Nama UMKM]</h1>
                        </div>
        
                        <div class="order-last">
                            <span class="close" onclick="closeModal()">
                                <ion-icon name="close-circle-outline" size="large"></ion-icon>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pb-3 mt-3 border-b">
                <p id="c1">1 Oktober 2024 12:15:10</p>
                <p>by <span id="c2">Ari</span></p>
            </div>

            <div class="flex flex-row mt-3 items-center justify-center gap-4">
                <div class="basis-1/2">
                    <button id="delete-button" type="button" class="justify-center inline-flex items-center px-4 py-2 bg-red-950 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Hapus
                    </button>
                </div>

                <div class="basis-1/2">
                    <button id="detail-button" type="button" class="justify-center inline-flex items-center px-4 py-2 bg-red-950 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Lihat Detil
                    </button>
                </div>
            </div>

        </div>
    </div>
    <x-navbottom/>

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
    function openModal(id, nama, c1, c2) {
        document.getElementById("myModal").style.display = "block";
        document.getElementById("umkm_title").innerHTML = nama;
        document.getElementById("c1").innerHTML = c1;
        document.getElementById("c2").innerHTML = c2;
        document.getElementById('detail-button').addEventListener('click', function() {
            window.location.href = "/transaksi/detil/" + id; 
        });
        console.log('id_umkm', id);
    }
        
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
    </script>
</div>