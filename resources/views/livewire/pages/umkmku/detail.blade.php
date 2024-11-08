{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php
use App\Libraries\myfunction;
?>
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
                <a href="{{ '/umkmku/edit/'.myfunction::enval($id_umkm).'/e' }}" style="margin-right: 20px;">
                    <ion-icon name="pencil-outline" size="large" style="margin-top: 5px;"></ion-icon>
                </a>

                <a href="{{ '/process/umkm/delete/'.$id_umkm }}">
                    <ion-icon name="trash-outline" size="large" style="margin-top: 5px;"></ion-icon>
                </a>
                
            </div>
        </div>
    </div>

    {{-- {{ $path_fotoumkm.', '.$path_logoumkm }} --}}
    <div class="py-6 px-6 static">
        <div class="flex justify-center">
            <div class="mr-3">
                @if( $foto_umkm == null || empty($foto_umkm) || is_null($foto_umkm) || $foto_umkm == '' )
                    <h1 class="text-2xl font-bold p-2 leading-tight">
                        Foto Belum Ada
                    </h1>
                @else
                    <img src="{{ $path_fotoumkm }}" style="width: 100%;" alt="" />
                @endif
                
            </div>

            <div class="ml-3">
                @if( $logo_umkm == null || empty($logo_umkm) || is_null($logo_umkm) || $logo_umkm == '' )
                    <h1 class="text-2xl font-bold p-2 leading-tight">
                        Logo Belum Ada
                    </h1>
                @else
                    <img src="{{ $path_logoumkm }}" style="width: 100%;" alt="" />
                @endif

            </div>
        </div>

        <div class="mt-3">
            <p><span class="font-bold">Nama UMKM : </span> {{ $nama_umkm }}</p>
            <p><span class="font-bold">Tanggal Berdiri : </span> {{ $tgl_berdiri }}</p>
            <p><span class="font-bold">Jenis Usaha : </span> {{ $jenis_usaha }}</p>
            <p><span class="font-bold">Deskripsi : </span> {{ $deskripsi }}</p>
            <p><span class="font-bold">Alamat : </span> {{ $alamat.', '.$longitude.', '.$latitude }}</p>
            <p><span class="font-bold">No. Telepon : </span> {{ $no_tlp }}</p>
        </div>
    </div> 

    <div class="py-6 px-6 mt-3 mb-3 static" style="width: 100%;">
        <nav class="flex flex-row">
            <div class="basis-1/4 flex-1 px-0 w-1/4">
                <button class="w-full text-white px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg" onclick="openTab('tab1')">
                    <ion-icon name="fast-food-outline"></ion-icon> <br/>
                    Produk
                </button>
            </div>

            <div class="basis-1/4 flex-1 px-0 w-1/4">
                <button class="w-full text-white px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg" onclick="openTab('tab2')">
                    <ion-icon name="cash-outline"></ion-icon> <br/>
                    Transaksi
                </button>
            </div>

            <div class="basis-1/4 flex-1 px-0 w-1/4">
                <button class="w-full text-white px-4 py-2 bg-gray-500 hover:bg-gray-700 rounded-lg" onclick="openTab('tab3')">
                    <ion-icon name="people-outline"></ion-icon> <br/>
                    Pegawai
                </button>
            </div>
        </nav>
      
        <div id="tab1" class="p-4 bg-white border-t border-gray-200 static">
            <a href="{{ '/produk/baru/'.myfunction::enval($id_umkm) }}">
                <div class="w-full text-center border-b border-gray-600">
                    <ion-icon name="add-outline" size="large"></ion-icon>
                </div>
            </a>

            @if ($data_produk)
                @foreach ($data_produk as $dt)
                <div class="static mt-3 flex flex-row justify-between border-b border-gray-600">
                    <div class="order-first">
                        <a href="{{ '/produk/detil/'.myfunction::enval($dt->id_produk).'/'.myfunction::enval($id_umkm) }}">
                            <p>{{ $dt->nama }}</p>
                        </a>
                    </div>
                    <div class="order-last ">
                        <span id="{{ 'prod'.myfunction::enval($dt->id_produk) }}" onclick="deleteProduk('{{ myfunction::enval($dt->id_produk) }}', '{{ $id_umkm }}')">
                            <ion-icon name="trash-outline" size="large" style="margin-top: 0px;"></ion-icon>
                        </span>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center">
                    <h1 class="font-bold text-2xl py-2 mb-2 border-b">
                        Data Produk Kosong
                    </h1>
                </div>
            @endif
            
        </div>

        <div id="tab2" class="hidden p-4 bg-white border-t border-gray-200 static">
            <div class="flex justify-center">
                <div class="">
                    <select id="tipe_viewtable_transaksi" class="block w-full rounded">
                        <option disabled selected>Pilih Tipe Detil Tabel</option>
                        <option disabled>----------</option>
                        <option value="harian">Harian</option>
                        <option value="mingguan">Mingguan</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                        <option value="custom">Dari ... Ke ...</option>
                    </select>
                </div>
                <div class="">
                    <x-secondary-button class="mx-3 mt-1 block w-full" onclick="viewTable()">
                        <ion-icon name="eye-outline"></ion-icon>
                    </x-secondary-button>
                </div>
                <div class="">
                    <div class="block w-full right">
                        <a href="{{ '/transaksi/baru/'.myfunction::enval($id_umkm) }}">
                            <div class="w-full text-center border-gray-600">
                                <ion-icon name="add-outline" size="large"></ion-icon>
                            </div>
                        </a>
                    </div>
                </div>
              </div>
            

            {{-- {{ $data_umkm[0]['id_umkm'] }} --}}
            
            {{-- <livewire:pages.transaksi.list_in_umkm :id_transaksi="$dt->id_transaksi" /> --}}
                    {{-- @include('livewire.pages.transaksi.list_in_umkm') --}}
                    {{-- @livewire('pages.transaksi.list_in_umkm', [
                        'id_transaksi' => $dt->id_transaksi, 
                        'tgl' => $dt->tgl
                    ]) 
            --}}

            {{-- {{ $data_transaksi }} --}}
            @if ($data_transaksi)
                @foreach ($data_transaksi as $dt)
                    <div class="static mt-3 flex flex-row justify-between border-b border-gray-600">
                        <div class="order-first">
                            <a href="{{ '/transaksi/detil/'.myfunction::enval($dt->id_transaksi) }}">
                                <p>{{ $dt->tgl }}</p>
                            </a>
                        </div>
                        <div class="order-last ">
                            <span id="{{ 'trans'.myfunction::enval($dt->id_transaksi) }}" onclick="deleteTransaksi('{{ myfunction::enval($dt->id_transaksi) }}', '{{ $dt->id_transaksi }}')">
                                <ion-icon name="trash-outline" size="large" style="margin-top: 0px;"></ion-icon>
                            </span>
                        </div>
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

        <div id="tab3" class="hidden p-4 bg-white border-t border-gray-200 static">
            <a href="{{ '/staff/baru/'.myfunction::enval($id_umkm) }}">
                <div class="w-full text-center border-b border-gray-600">
                    <ion-icon name="add-outline" size="large"></ion-icon>
                </div>
            </a>

            @if ($data_user)
                @foreach ($data_user as $dtu)
                    <div class="static mt-3 flex flex-row justify-between border-b border-gray-600">
                        <div class="order-first">
                            <a href="{{ '/staff/detil/'.myfunction::enval($dtu->id) }}">
                                <p>{{ $dtu->nama }}</p>
                            </a>
                        </div>
                        <div class="order-last text-black">
                            <span id="{{ 'pegawai'.myfunction::enval($dtu->id) }}" onclick="deletePegawai('{{ myfunction::enval($dtu->id) }}', '{{ $id_umkm }}', '{{ $dtu->nama }}')">
                                <ion-icon name="trash-outline" size="large" style="margin-top: 0px;"></ion-icon>
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <h1 class="font-bold text-2xl py-2 mb-2 border-b">
                        Data Pegawai Kosong
                    </h1>
                </div>
            @endif

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

    function viewTable() {
        let tipe = document.getElementById("tipe_viewtable_transaksi").value;
        window.open(`/transaksi/detil/view/${tipe}/{{ $id_umkm }}/null/null`, value="_self");
    }

    function deleteProduk(id1, id2, nama) {
        let url = `/process/produk/delete/${id1}/${id2}`;
        Swal.fire({
            title: "Anda yakin ingin menghapus data produk ini? ".nama,
            text: "Anda tidak dapat mengembalikan data ini kembali",
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: "Ya",
            denyButtonText: `Tidak`,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Dihapus!",
                    text: "Data Produk Anda Telah Berhasil Dihapus!",
                    icon: "success"
                });
                window.open(url, value="_self");
            }
        });
    }

    function deleteTransaksi(id1, id2) {
        let url = `/process/transaksi/delete/${id1}/${id2}`;
        Swal.fire({
            title: "Anda yakin ingin menghapus data transaksi ini? ".nama,
            text: "Anda tidak dapat mengembalikan data ini kembali",
            icon: "warning",
            showDenyButton: true,
            confirmButtonText: "Ya",
            denyButtonText: `Tidak`,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Dihapus!",
                    text: "Data Transaksi Anda Telah Berhasil Dihapus!",
                    icon: "success"
                });
                window.open(url, value="_self");
            }
        });
    }

    function deletePegawai(id1, id2, nama) {
        let url = `/process/staff/delete/${id1}/${id2}`;
        Swal.fire({
            title: `Anda Yakin ini menghapus data pegawai ini? ${nama}`,
            text: `Anda tidak dapat mengembalikan data ini kembali`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Dihapus!",
                    text: "Data Pegawai Anda Telah Berhasil Dihapus!",
                    icon: "success"
                });
                window.open(url, value="_self");
            }
        });
    }
</script>   
</div>   