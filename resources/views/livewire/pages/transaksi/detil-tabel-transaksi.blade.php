{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex">
            <div class="">
                <a href="{{ '/umkmku/detil/'.$id_umkm }}" class="font-bold p-2 text-white leading-tight">
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

    <div class="py-6 px-6 static">
        <div class="flex flex-row">
        @if($tipe == 'harian')
            <div>
                <input type="date" id="date_today" class="block w-full rounded" /> 
            </div>

            <div>
                <x-secondary-button class="mt-1 block w-full" onclick="viewTableHarian()">
                    Lihat Tabel
                </x-secondary-button>
            </div>
        @elseif ($tipe == 'mingguan')
            <div>
                <select id="select_minggu" class="block w-full rounded">
                    <option disabled selected>Minggu Ke-</option>
                    <option disabled>----------</option>
                    @for($x=1; $x<5; $x++)
                        <option value="{{ $x }}">{{ $x }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <select id="select_bulan" class="block w-full rounded">
                    <option disabled selected>Pilih Bulan</option>
                    <option disabled>----------</option>
                    @for($x=1; $x<13; $x++)
                        @php
                            $month_num = $x; 
                            $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
                        @endphp
                        <option value="{{ $x }}">{{ $month_name }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <select id="select_tahun" class="block w-full rounded">
                    <option disabled selected>Pilih Tahun</option>
                    <option disabled>----------</option>
                    @for($x=0; $x<50; $x++)
                        @php
                            $counter = $tahun_sekarang - $x
                        @endphp
                        <option value="{{ $counter }}">{{ $counter }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <x-secondary-button class="mt-1 block w-full" onclick="viewTableMingguan()">
                    Lihat Tabel
                </x-secondary-button>
            </div>
        @elseif ($tipe == 'bulanan')
            <div>
                <select id="select_bulan" class="block w-full rounded">
                    <option disabled selected>Pilih Bulan</option>
                    <option disabled>----------</option>
                    @for($x=1; $x<13; $x++)
                        @php
                            $month_num = $x; 
                            $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
                        @endphp
                        <option value="{{ $x }}">{{ $month_name }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <select id="select_tahun" class="">
                    <option disabled selected>Pilih Tahun</option>
                    <option disabled>----------</option>
                    @for($x=0; $x<50; $x++)
                        @php
                            $counter = $tahun_sekarang - $x
                        @endphp
                        <option value="{{ $counter }}">{{ $counter }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <x-secondary-button class="mt-1 block w-full" onclick="viewTableBulanan()">
                    Lihat Tabel
                </x-secondary-button>
            </div>
        @elseif ($tipe == 'tahunan')
            <div>
                <select id="select_tahun" class="block w-full rounded">
                    <option disabled selected>Pilih Tahun</option>
                    <option disabled>----------</option>
                    @for($x=0; $x<50; $x++)
                        @php
                            $counter = $tahun_sekarang - $x
                        @endphp
                        <option value="{{ $counter }}">{{ $counter }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <x-secondary-button class="mt-1 block w-full" onclick="viewTableTahunan()">
                    Lihat Tabel
                </x-secondary-button>
            </div>
        @elseif ($tipe == 'custom')
            <div>
                <span class="font-bold">Dari</span>
                <input type="date" id="date_from" class="rounded" /> 
            </div>

            <div>
                <span class="font-bold">Hingga</span>
                <input type="date" id="date_to" class="rounded" /> 
            </div>

            <div>
                <x-secondary-button class="mt-1 block w-full" onclick="viewTableCustom()">
                    Lihat Tabel
                </x-secondary-button>
            </div>
        @else 
            <div class="items-center">
                404!
            </div>
        @endif
        </div>
    </div>

    <div class="py-6 px-6">
        {{ $data_transaksi }}
        @if ($data_transaksi)
            <table class="border-collapse table-fixed w-full text-sm">
                <thead>
                    <tr>
                        <th class="py-2 border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Tanggal</th>
                        <th class="py-2 border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Pendapatan</th>
                    </tr>
                </thead>
        
                <tbody>
                    @for($x=1; $x<32; $x++)
                        @php $total = $total + ($x*1000); @endphp
                        <tr class="border-b">
                            <td class="py-2">{{ date('Y-m-'.$x) }}</td>
                            <td class="py-2" style="text-align: right;">{{ number_format($x*1000,2,",",".") }}</td>
                        </tr>
                    @endfor
                </tbody>
        
                <tfoot>
                    <tr>
                        <th class="py-2">Total</th>
                        <td class="py-2" style="text-align: right;">
                            {{ number_format($total,2,",",".") }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        @else
            <div class="text-center">
                <h1 class="font-bold text-2xl py-2 mb-2 border-b">
                    Pilih Tanggal
                </h1>
            </div>
        @endif
    </div>

    <script>
    function viewTableHarian() {
        let date = document.getElementById('date_today').value;
        window.open(`/transaksi/detil/view/harian/{{ $id_umkm }}/${date}/null`, value="_self");
    }

    function viewTableMingguan() {

    }

    function viewTableBulanan() {
        let bulan = document.getElementById('select_bulan :options').value;
        let tahun = document.getElementById('select_tahun :options').value;
        let date = `${$tahun}-${bulan}`;
        window.open(`/transaksi/detil/view/harian/{{ $id_umkm }}/${date}/null`, value="_self");
    }

    function viewTableTahunan() {
        let tahun = document.getElementById('select_tahun :options').value;
        window.open(`/transaksi/detil/view/harian/{{ $id_umkm }}/${tahun}/null`, value="_self");
    }

    function viewTableCustom() {
        let from = document.getElementById('date_from').value;
        let to = document.getElementById('date_to').value;
        window.open(`/transaksi/detil/view/harian/{{ $id_umkm }}/${from}/${to}`, value="_self");
    }
    </script>
</div>