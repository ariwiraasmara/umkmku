{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<div class="flex flex-col static">
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2">
            <h1 class="text-2xl font-bold p-2 text-white leading-tight">
                {{ $title }}
            </h1>
        </div>
    </div>

    <div class="py-12 static">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- ?Foto --}}
            <form action="/process/user/update/foto" method="POST">
                @csrf

                <div class="flex flex-col static items-center justify-center">
                    <div class="">
                        @if ($data[0]['foto'] == null || empty($data[0]['foto']) || is_null($data[0]['foto'] || $data[0]['foto'] = '') )
                            <h1 class="text-2xl font-bold text-center">
                                Belum Ada Foto
                            </h1>
                        @else
                            <img src="{{ '/public/user/photos'.$data[0]['foto'] }}" />
                        @endif
                    </div>

                    <div class="mt-3 flex flex-row justify-between">
                        <div>
                            <input wire:model="foto" value="{{ $data[0]['foto'] }}" id="foto" class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="foto" autofocus autocomplete="foto" />
                        </div>

                        <div>
                            <x-primary-button class="block w-full justify-center">
                                <ion-icon name="save-outline" size="" style="font-size : 20px"></ion-icon>
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>

            <hr/>

            <form action="/process/user/update" method="POST">
                @csrf
                <input type="hidden" value="{{ $data[0]['id_umkm'] }}" readonly disabled />

                {{-- ?Username --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">Username: </span> {{ $data[0]['username'] }}
                </div>

                {{-- ?Email --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">Email: </span> {{ $data[0]['email'] }}
                </div>

                {{-- ?Nama --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Nama') }}</span>
                    <input wire:model="nama" value="{{ $data[0]['nama'] }}" id="nama" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nama"  autofocus autocomplete="nama" />
                </div>

                {{-- ?JK --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">Jenis Kelamin :</span>
                    <span class="ml-3">
                        <input id="pria" type="radio" value="Pria" name="jk" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($data[0]['jk'] == 'Pria') checked @endif>
                        <label for="pria" class="ml-2 text-sm text-black dark:text-black">&nbsp;Pria</label>    
                    </span>
                    <span class="ml-3">
                        <input id="wanita" type="radio" value="Wanita" name="jk" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" @if($data[0]['jk'] == 'Wanita') checked @endif>
                        <label for="wanita" class="ml-2 text-sm text-black dark:text-black">&nbsp;Wanita</label>
                    </span>
                </div>

                {{-- ?Tempat, Tanggal Lahir --}}
                <div class="flex flex-row gap-2 mt-3">
                    <div class="basis-1/2 flex-1">
                        <span class="text-sm text-black font-bold">{{ __('Tempat,') }}</span>
                        <input wire:model="tempat_lahir" value="{{ $data[0]['tempat_lahir'] }}" id="tempat_lahir" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="tempat_lahir"  autofocus autocomplete="tempat_lahir" />
                    </div>
                    <div class="basis-1/2 flex-1">
                        <span class="text-sm text-black font-bold">{{ __('Tanggal Lahir') }}</span>
                        <input wire:model="tgl_lahir" value="{{ $data[0]['tgl_lahir'] }}" id="tgl_lahir" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="date" name="tgl_lahir"  autofocus autocomplete="tgl_lahir" />
                    </div>
                </div>

                {{-- ?Penempatan UMKM, Jabatan, Status Aktif --}}
                <div class="flex flex-row gap-2 mt-3">
                    <div class="basis-1/4 flex-1">
                        <span class="text-sm text-black font-bold">{{ __('UMKM Di :') }}</span>
                        <select wire:model="id_umkm" id="id_umkm" name="id_umkm" class="block mt-1 w-full rounded" @if($data[0]['roles'] > 2) readonly disabled @endif>
                            <option value="" disabled>Pilih UMKM</option>
                            <option value="" disabled>---</option>
                            <option value="">Tidak Ada</option>
                        </select>
                    </div>
                    <div class="basis-1/4 flex-1">
                        <span class="text-sm text-black font-bold">{{ __('Jabatan') }}</span>
                        <input wire:model="jabatan" value="{{ $data[0]['jabatan'] }}" id="jabatan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="jabatan"  autofocus autocomplete="jabatan" @if($data[0]['roles'] > 2) readonly disabled @endif />
                    </div>
                    <div class="basis-1/4 flex-1">
                        <span class="text-sm text-black font-bold">{{ __('Status') }}</span>
                        <select wire:model="status" id="status" name="id_umkm" class="block mt-1 w-full rounded" @if($data[0]['roles'] > 2) readonly disabled @endif>
                            <option value="">Aktif</option>
                            <option value="">Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                {{-- ?No. Telepon --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('No. Telepon') }}</span>
                    <input wire:model="tlp" value="{{ $data[0]['tlp'] }}" id="tlp" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="tlp" autofocus autocomplete="tlp" />
                </div>

                

                {{-- ?Alamat --}}
                <div class="mt-3">
                    <span class="text-sm text-black font-bold">{{ __('Alamat') }}</span>
                    <input wire:model="alamat" value="{{ $data[0]['alamat'] }}" id="alamat" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="alamat"  autofocus autocomplete="alamat" />
                </div>

                <x-primary-button class="mt-3 block w-full justify-center">
                    {{ __('Simpan') }}
                </x-primary-button>
            </form>

            <hr/>

            {{-- ?Password --}}
            <div class="mt-3">
                <span class="text-sm text-black font-bold">{{ __('Update Password') }}</span>
                <form action="{{ '/process/user/update/password/'.$data[0]['id'] }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-2">
                        <div class="">
                            <input wire:model="password" id="password" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="password" autofocus autocomplete="password" />
                        </div>
    
                        <div class="">
                            <x-primary-button class="block w-full justify-center">
                                <ion-icon name="save-outline" size="" style="font-size : 23px"></ion-icon>
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="mb-3"></div>
        </div>
    </div>
    <x-navbottom/>
</div>