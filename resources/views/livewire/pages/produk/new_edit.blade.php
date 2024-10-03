{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
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

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <form action="{{ $url }}" method="{{ $method_request }}">
                @csrf

                {{-- ? id_produk dan id_umkm hidden --}}
                <input wire:model="id_produk" :value="{{ $id_produk }}" id="id_produk" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="hidden" name="id_produk" required autofocus autocomplete="id_produk" />
                <input wire:model="id_umkm" :value="{{ $id_umkm }}" id="id_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="hidden" name="id_umkm" required autofocus autocomplete="id_umkm" />
                
                {{-- ? nama --}}
                <div>
                    <span class="text-sm text-black font-bold">{{ __('Nama Produk') }}</span>
                    <input wire:model="nama" :value="{{ $nama }}" id="nama_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nama" required autofocus autocomplete="nama" />
                </div>

                {{-- ? merk --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Merk *boleh dikosongkan') }}</span>
                    <input wire:model="merk" id="tgl_berdiri" :value="{{ $merk }}" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="merk" required autofocus autocomplete="merk"/>
                </div>

                {{-- ? jenis --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Jenis *boleh dikosongkan') }}</span>
                    <input wire:model="jenis" :value="{{ $jenis }}" id="jenis" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="jenis" required autofocus autocomplete="jenis" />
                </div>

                {{-- ? deskripsi --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Deskripsi *boleh dikosongkan') }}</span>
                    <input wire:model="deskripsi" :value="{{ $deskripsi }}" id="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="deskripsi" required autofocus autocomplete="deskripsi" />
                </div>

                {{-- ? harga --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Harga') }}</span>
                    <input wire:model="harga" :value="{{ $harga }}" id="no_tlp" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="harga" required autofocus autocomplete="harga" />
                </div>

                {{-- ? stok --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Stok') }}</span>
                    <input wire:model="stok" :value="{{ $stok }}" id="no_tlp" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="number" name="stok" required autofocus autocomplete="stok" />
                </div>

                {{-- ? satuan_unit --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Satuan Unit') }}</span>
                    <input wire:model="satuan_unit" :value="{{ $satuan_unit }}" id="no_tlp" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="satuan_unit" required autofocus autocomplete="satuan_unit" />
                </div>

                {{-- ? diskon --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Diskon') }}</span>
                    <input wire:model="diskon" :value="{{ $diskon }}" id="no_tlp" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="diskon" required autofocus autocomplete="diskon" />
                </div>

                <x-primary-button class="mt-3 block w-full justify-center">
                    {{ __('Simpan') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>