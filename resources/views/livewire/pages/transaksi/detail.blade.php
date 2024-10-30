{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
{{-- - Nama UMKM beserta Alamatnya.
- Tanggal Transaksi Tercatat.
- Siapa yang menginput data transaksinya.
- Detail informasi produk yang dibeli.
- Total Belanja
- Uang yang diterima.
- Uang kembalian = Uang yang diterima - Total Belanja. --}}

<div>
    {{ $data }}
    <div class="flex flex-col static items-center justify-center p-2 border-b">
        @if( $data['data'][0]['logo_umkm'] != null || $data['data'][0]['logo_umkm'] != '' || !empty($data['data'][0]['logo_umkm']) || !is_null($data['data'][0]['logo_umkm']) )        
            <img src='{{ 'public/user/photos/'.$data['data'][0]['logo_umkm'] }}' height="100" width="100" alt="{{ $data['data'][0]['nama_umkm'] }}" />
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
                            {{ number_format($subtotal - $dtr->diskon,2,",",".")  }}
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
</div>