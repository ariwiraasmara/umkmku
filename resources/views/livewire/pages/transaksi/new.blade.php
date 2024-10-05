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
            <form action="/process/transaksi/baru/" method="POST">
                @csrf

                {{-- ? id_umkm dan id_user hidden --}}
                <input wire:model="id_umkm" value="{{ $id_umkm }}" id="id_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="hidden" name="id_umkm" required autofocus autocomplete="id_umkm" />
                
                <div>
                    <span class="font-bold">Data diinput oleh : {{ $nama_user }} </span>
                </div>

                {{-- ? nama_pelanggan --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Nama Pelanggan') }}</span>
                    <input wire:model="nama_pelanggan" id="nama_pelanggan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nama_pelanggan" required autofocus autocomplete="nama_pelanggan" />
                </div>

                {{-- ? uang_diterima --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Uang Diterima') }}</span>
                    <input wire:model="uang_diterima" id="uang_diterima" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="uang_diterima" required autofocus autocomplete="uang_diterima" />
                </div>

                {{-- ? diskon --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Diskon *beri nilai nol (0) jika tidak ada diskon*') }}</span>
                    <input wire:model="diskon" id="diskon" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="diskon" required autofocus autocomplete="diskon"/>
                </div>

                {{-- ? detail produk transaksi. append kebawah --}}
                <div class="mt-3" id="detail_produk_transaksi">
                    <div class="static grid grid-cols-2 gap-4">
                        <div><span class="text-sm text-black font-bold">{{ __('Tambah Produk') }}</span></div>
                        <div><span class="text-sm text-black font-bold">{{ __('Jumlah Produk') }}</span></div>
                    </div>
                    <livewire:pages.transaksi.append-produk-detil-transaksi />
                    <livewire:pages.transaksi.append-produk-detil-transaksi />
                    <livewire:pages.transaksi.append-produk-detil-transaksi />
                    <livewire:pages.transaksi.append-produk-detil-transaksi />
                    <livewire:pages.transaksi.append-produk-detil-transaksi />
                </div>

                <div>
                    <button type="button" id="add_produk" class="mt-3 block w-full justify-center">
                        <ion-icon name="add-circle-outline" size="large"></ion-icon>
                    </button>
                </div>

                <x-primary-button class="mt-3 block w-full justify-center">
                    {{ __('Simpan') }}
                </x-primary-button>
            </form>
        </div>
    </div>

    <script>
        // let div = document.createElement("div");
        // const textnode = document.createTextNode("Water");
        // div.appendChild(textnode);
        // document.getElementById("detail_produk_transaksi").append(div);

        // document.getElementById('add_produk').addEventListener('click', function() {
        //     document.getElementById('detail_produk_transaksi').appendChild = "hellow tambah"; //"";
        // });
    </script>
</div>