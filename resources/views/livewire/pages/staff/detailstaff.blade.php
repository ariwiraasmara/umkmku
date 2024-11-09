{{--! Copyright @ Syahri Ramadhan Wiraasmara --}}
<?php
use App\Libraries\myfunction;
?>
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex">
            <div class="">
                <a href="{{ '/umkmku/detil/'.$data[0]['id_umkm'] }}" class="font-bold p-2 text-white leading-tight">
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
        @if ($data[0]['foto'] == null || empty($data[0]['foto']) || is_null($data[0]['foto'] || $data[0]['foto'] = '') )
            <div class="flex justify-center">
                <div>
                    <h1 class="text-2xl font-bold text-center">
                        Belum Ada Foto
                    </h1>
                </div>
            </div>
        @else
            <div class="flex justify-center">
                <div>
                    <img src="{{ $path_foto }}" width="500" height="500" alt="{{ $data[0]['nama'] }}"/>
                </div>
            </div>
        @endif
        
        <div class="">
            <p><span class="font-bold">Nama : </span> {{ $data[0]['nama'] }}</p>
            <p><span class="font-bold">Username : </span> {{ $data[0]['username'] }}</p>
            <p><span class="font-bold">Email : </span> {{ $data[0]['email'] }}</p>
            <p><span class="font-bold">No. Telepon : </span> {{ $data[0]['tlp'] }}</p>
            <p><span class="font-bold">Jenis Kelamin : </span> {{ $data[0]['jk'] }}</p>
            <p><span class="font-bold">Tempat, Tanggal Lahir : </span> {{ $data[0]['tempat_lahir'].', '.$data[0]['tgl_lahir'] }}</p>
            <p><span class="font-bold">Alamat : </span> {{ $data[0]['alamat'] }}</p>
            <p><span class="font-bold">Di Tempatkan Di UMKM : </span> {{ $data[0]['nama_umkm'] }}</p>
            <p><span class="font-bold">Status : </span> {{ $data[0]['status'] }}</p>
            <p><span class="font-bold">Jabatan : </span> {{ $data[0]['jabatan'] }}</p>
        </div>
        
        <div class="flex items-center justify-center mt-3">
            <div class="flex-initial w-50">
                <a href="{{ '/staff/edit/'.myfunction::enval($data[0]['id']).'/e' }}">
                    <x-secondary-button class="ms-3">
                        <ion-icon name="pencil-outline" size="large" style="margin-top: 5px;"></ion-icon>
                    </x-secondary-button>
                </a>
            </div>
            
            <div class="flex-initial w-50">
                <span onclick="deletePegawai('{{ myfunction::enval($data[0]['id']) }}', '{{ $data[0]['id_umkm'] }}', '{{ $data[0]['nama'] }}')">
                    <x-secondary-button class="ms-3">
                        <ion-icon name="trash-outline" size="large" style="margin-top: 5px;"></ion-icon>
                    </x-secondary-button>
                </span>
            </div>
        </div>
    </div> 

    <script>
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
