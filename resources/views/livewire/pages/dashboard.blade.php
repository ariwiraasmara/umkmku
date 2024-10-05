{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2 flex justify-between">
            <div class="order-first">
                <h1 class="text-2xl font-bold p-2 text-white leading-tight">
                    {{ $title }}
                </h1>
            </div>
            
            <div class="order-last">
                <a href="#transaksi/baru" class="font-bold p-2 text-white leading-tight">
                    <ion-icon name="add-circle-outline" style="font-size: 45px;"></ion-icon>
                </a>
            </div>
        </div>
    </div>

    <div class="p-2 static" style="margin-bottom: 50px;">
        <h2 class="text-black text-xl font-bold">Selamat Datang, {{ $username }}</h2>
        
        {{-- @foreach ($data as $d)
            <livewire:pages.transaksi.list_in_dashboard :id_umkm="$d['id_umkm']" :nama_umkmku="$d['nama_umkmku']" :waktu="$d['waktu']" :kasir="$d['kasir']"  />
        @endforeach --}}

        {{-- <a href="#transaksi/baru" class="inline-flex items-center p-4 m-3 bg-sky-800 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-600 focus:bg-sky-500 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 fixed bottom-0 right-0">
            <ion-icon name="add-outline" size="large"></ion-icon>
        </a> --}}
    </div>
    <x-navbottom/>
</div>