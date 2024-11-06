{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<div>
    {{-- {{ $data }} --}}
    <div class="flex flex-col static items-center justify-center p-2 border-b">
        @if( $data['data'][0]['logo_umkm'] != null || $data['data'][0]['logo_umkm'] != '' || !empty($data['data'][0]['logo_umkm']) || !is_null($data['data'][0]['logo_umkm']) )        
            <img src='{{ $path_logo }}' height="100" width="100" alt="{{ $data['data'][0]['nama_umkm'] }}" />
        @endif

        {{-- <img src='https://images.pexels.com/photos/417173/pexels-photo-417173.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1' height="100" width="100" alt="{{ $data['data'][0]['nama_umkm'] }}" /> --}}
        <h1 class="text-2xl font-bold text-black leading-tight mt-2">{{ $data['data'][0]['nama_umkm'] }}</h1>
        <p class="font-bold text-black leading-tight mt-2">
            {{ $data['data'][0]['alamat'] }}
        </p>
        <p class="font-bold text-black underline-offset-1 leading-tight mt-2">
            Telp : {{ $data['data'][0]['no_tlp'] }}
        </p>
    </div>

    <div class="static border-b p-2">
        <table class="auto text-left">
            <tbody>
                <tr>
                    <td class="font-bold">No. Transaksi</td>
                    <td>:</td>
                    <td>{{ $data['data'][0]['id_transaksi'] }}</td>
                </tr>

                <tr>
                    <td class="font-bold">Tanggal</td>
                    <td>:</td>
                    <td>{{ $data['data'][0]['tgl'] }}</td>
                </tr>

                <tr>
                    <td class="font-bold">Kasir</th>
                    <td>:</th>
                    <td>{{ $data['data'][0]['nama_kasir'] }}</td>
                </tr>

                <tr>
                    <td class="font-bold">Pelanggan</td>
                    <td>:</th>
                    <td>{{ $data['data'][0]['nama_pelanggan'] }}</th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="p-2 static border-b" x-data="{ {{ $data['detail_transaksi'] }} }">
        {{-- 
        // detailtransaksi1 | fulan | 2024-09-28 | fulani | Bakso Kikil | Warung Fulan | 10000 | 0 | 1 | porsi | 0 | 1000 | 9000 |
        // detailtransaksi2 | fulan | 2024-09-28 | fulani | Bakso Daging | Warung Fulan | 12000 | 2000 | 1 | porsi | 0 | 10000 |
        // detailtransaksi3 | fulan | 2024-09-28 | fulano | Bakso Ikan | Warung Fulan | 15000 | 2000 | 3 | porsi | 1000 | 39000 | 
        --}}
            
        @if ($data['detail_transaksi'])
            @foreach ($data['detail_transaksi'] as $dtr)
                @php 
                    $subtotal = $dtr->harga * $dtr->jumlah_dibeli 
                @endphp
                <div>
                    <p><span class="font-bold">{{ $incx.'). '.$dtr->produk }},</span> {{ $dtr->jumlah_dibeli.' '.$dtr->satuan_unit }}</p>
                    <div class="flex flex-row justify-between">
                        <div class="order-first">
                            Rp. {{ number_format($dtr->harga,2,",",".");  }} x {{ $dtr->jumlah_dibeli }} - <span class="italic">(dis.) {{ number_format($dtr->diskon,2,",",".")  }}</span>
                        </div>
                        <div class="order-last">
                            {{ number_format($subtotal - $dtr->diskon,2,",",".") }}
                        </div>
                    </div>
                </div>
                @php 
                    $incx++; 
                    $sub = $sub + ( $subtotal - $dtr->diskon )
                @endphp
            @endforeach
        @else  
            <div><p>No Data</p></div>
        @endif
    </div>

    <div class="p-2 static border-b">
        <div class="flex flex-row justify-between">
            <div class="order-first">
                Sub Total Produk
            </div>
            <div class="order-last">
                {{ number_format($sub,2,",",".") }}
            </div>
        </div>

        <div class="flex flex-row justify-between">
            <div class="order-first">
                Diskon
            </div>
            <div class="order-last">
                {{ number_format($data['data'][0]['diskon'],2,",",".") }}
            </div>
        </div>
    </div>

    @php 
        $totalakhir = $sub - $data['data'][0]['diskon'];
        $uangkembalian = $data['data'][0]['uang_diterima'] - $totalakhir;
    @endphp
    <div class="p-2 static border-b">
        <div class="flex flex-row justify-between">
            <div class="order-first font-bold text-lg">
                Total
            </div>
            <div class="order-last">
                {{ number_format($totalakhir,2,",",".") }}
            </div>
        </div>

        <div class="flex flex-row justify-between">
            <div class="order-first font-bold text-lg">
                Dibayar
            </div>
            <div class="order-last">
                {{ number_format($data['data'][0]['uang_diterima'],2,",",".") }}
            </div>
        </div>

        <div class="flex flex-row justify-between">
            <div class="order-first font-bold text-lg">
                Kembalian
            </div>
            <div class="order-last">
                {{ number_format($uangkembalian,2,",",".") }}
            </div>
        </div>
    </div>

    <div class="p-2 static mb-3">
        <div class="flex flex-row items-center justify-center gap-4">
            <div class="underline text-blue" onclick="openModalShare()">
                Share
            </div>

            <button type="button" class="underline text-blue" onclick="window.print()">
                Print Or Export to PDF
            </button>
        </div>
    </div>

    <div id="modalShare" class="modal">
        <div class="modal-content">
            <div class="flex flex-row border-b">
                <div class="grow w-full static">
                    <div class="inset-x-0 top-0 p-2 flex justify-between">
                        <div class="order-first mt-1">
                            <h1 id="umkm_title" class="text-lg font-bold">Share Nota</h1>
                        </div>
        
                        <div class="order-last">
                            <span class="close" onclick="closeModalShare()">
                                <ion-icon name="close-circle-outline" size="large"></ion-icon>
                            </span>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="pb-3 mt-3">
                <input type="text" id="share-link" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" readonly />
                <x-secondary-button class="mt-3 block w-full items-center justify-center" onclick="myFunction()">
                    {{ __('Copy') }}
                </x-secondary-button>
            </div>
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
    document.getElementById("share-link").value = window.location.href;
    function openModalShare() {
        document.getElementById("modalShare").style.display = "block";
    }
        
    function closeModalShare() {
        document.getElementById("modalShare").style.display = "none";
    }

    function myFunction() {
        // Get the text field
        let copyText = document.getElementById("share-link");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
        
        // Alert the copied text
        alert(`Link Telah Dikopi! Siap di bagikan!`);
    }
    </script>
</div>