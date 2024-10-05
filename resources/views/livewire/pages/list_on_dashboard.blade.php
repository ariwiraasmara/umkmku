{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<div class="static">
    <div class="p-2 static mb-3">
        <div class="border-b border-gray-600 py-2 mb-2" 
             onclick="openModal({{ $id_umkm }}, {{ '\''.$nama_umkmku.'\'' }}, {{  '\''.$waktu.'\'' }}, {{ '\''.$kasir.'\'' }})">
            <p>{{ $nama_umkmku }}</p>
            <p>{{ $waktu }}</p>
            <p>by {{ $kasir }}</p>
        </div>
        {{-- ? Disini menampilkan daftar item list transaksi yang dimiliki.  --}}
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="flex flex-row border-b">
                <div class="grow w-full static">
                    <div class="inset-x-0 top-0 p-2 flex justify-between">
                        <div class="order-first mt-1">
                            <h1 id="umkm_title" class="text-lg font-bold">{{ $nama_umkmku }}</h1>
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
                <p id="c1">{{ $waktu }}</p>
                <p>by <span id="c2">{{ $kasir }}</span></p>
            </div>

            <div class="flex flex-row mt-3 items-center justify-center gap-4">
                <div class="basis-1/2">
                    <button id="{{ 'delete-button-'.$id_umkm }}" wire:click="delete" wire:confirm="Are you sure you want to delete this post?" type="button" class="justify-center inline-flex items-center px-4 py-2 bg-red-950 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Hapus
                    </button>
                </div>

                <div class="basis-1/2">
                    <a href="{{ '/umkmku/detail/'.$id_umkm }}" id="{{ 'detail-button-'.$id_umkm }}" type="button" target="" class="justify-center inline-flex items-center px-4 py-2 bg-red-950 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Lihat Detil
                    </a>
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