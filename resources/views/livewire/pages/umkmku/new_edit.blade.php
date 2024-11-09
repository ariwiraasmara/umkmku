{{--! Copyright @ Syahri Ramadhan Wiraasmara --}}
<?php
use App\Libraries\myfunction;
?>
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex">
            <div class="">
                <a href="/umkmku" class="font-bold p-2 text-white leading-tight">
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

    <div class="py-6 px-6">
        <div class="">
            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ? id_umkm dan id_user hidden --}}
                <input wire:model="id_umkm" value="{{ $id_umkm }}" id="id_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="hidden" name="id_umkm" required autofocus autocomplete="id_umkm" />
                
                {{-- ? nama_umkm --}}
                <div>
                    <span class="text-sm text-black font-bold">{{ __('Nama Umkm') }}</span>
                    <input wire:model="nama_umkm" value="{{ $nama_umkm }}" id="nama_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nama_umkm" required autofocus autocomplete="nama_umkm" />
                </div>

                {{-- ?tgl_berdiri --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Tanggal Berdiri') }}</span>
                    <input wire:model="tgl_berdiri" value="{{ $tgl_berdiri }}" id="tgl_berdiri" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="date" name="tgl_berdiri" required autofocus />
                </div>

                {{-- ? jenis_usaha --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Jenis Usaha') }}</span>
                    <input wire:model="jenis_usaha" value="{{ $jenis_usaha }}" id="jenis_usaha" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="jenis_usaha" required autofocus autocomplete="jenis_usaha" />
                </div>

                {{-- ? deskripsi --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Deskripsi') }}</span>
                    <input wire:model="deskripsi" value="{{ $deskripsi }}" id="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="deskripsi" required autofocus autocomplete="deskripsi" />
                </div>

                {{-- ? no_tlp --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('No. Telepon') }}</span>
                    <input wire:model="no_tlp" value="{{ $no_tlp }}" id="no_tlp" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="no_tlp" required autofocus autocomplete="no_tlp" />
                </div>

                {{-- ? logo_umkm --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Logo UMKM') }}</span>
                    <img src="" />
                    <input wire:model="logo_umkm" id="logo_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="logo_umkm" autofocus autocomplete="logo_umkm" />
                </div>

                {{-- ? foto_umkm --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Foto UMKM') }}</span>
                    <img src="" />
                    <input wire:model="foto_umkm" id="foto_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="foto_umkm" autofocus autocomplete="foto_umkm" />
                </div>

                {{-- ? alamat --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Alamat') }}</span>
                    <input wire:model="alamat" value="{{ $alamat }}" id="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="alamat" required autofocus autocomplete="alamat" />
                </div>

                <div class="mt-3">
                    <span class="italic underline">*Nilai Longitude dan Latitude Didapatkan dari aplikasi Google</span>
                </div>
                
                {{-- ? longitude --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Nilai Longitude') }}</span>
                    <input wire:model="longitude" value="{{ $longitude }}" id="longitude" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="longitude" autofocus autocomplete="longitude" />
                </div>

                {{-- ? latitude --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Nilai Latitude') }}</span>
                    <input wire:model="latitude" value="{{ $latitude }}" id="latitude" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="latitude" autofocus autocomplete="latitude" />
                </div>

                <x-primary-button class="mt-3 block w-full justify-center">
                    {{ __('Simpan') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>