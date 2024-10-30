{{-- ! Copyright @ Syahri Ramadhan Wiraasmara --}}
{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
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

    <div class="p-2 static">

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
                    <img src="{{ '/public/user/photos/'.$data[0]['foto'] }}" width="500" height="500" alt="{{ $data[0]['nama'] }}"/>
                </div>
            </div>
        @endif
        
        <div class="mt-3 ml-3">
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
                <a href="{{ '/staff/edit/'.$data[0]['id'].'/e' }}">
                    <x-secondary-button class="ms-3">
                        {{ __('Edit') }}
                    </x-secondary-button>
                </a>
            </div>
            
            <div class="flex-initial w-50">
                <a href="{{ '/process/staff/delete/'.$data[0]['id'].'/'.$data[0]['id_umkm'] }}">
                    <x-secondary-button class="ms-3">
                        {{ __('Hapus') }}
                    </x-secondary-button>
                </a>
            </div>
        </div>
    </div> 

</div>   
