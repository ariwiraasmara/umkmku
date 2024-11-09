{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
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

    <div class="py-6 px-6">
        <div class="">
            
            <form action="{{ $url }}" method="POST">
                @csrf
                {{-- ? id_umkm hidden --}}
                <input wire:model="id_umkm" value="{{ $id_umkm }}" id="id_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="hidden" name="id_umkm" required autofocus autocomplete="id_umkm" readonly />
                
                @if ($isedit == 'edit')
                    @if ($foto == null || empty($foto) || is_null($foto) || $foto = '')
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
                                <img src="{{ '/public/user/foto/'.$foto }}" height="100" width="100"/>
                            </div>
                        </div>
                    @endif
                    
                    <p><span class="text-black font-bold">Nama :</span>  {{ $nama }}</p>
                    <p><span class="text-black font-bold">Username :</span>  {{ $username }}</p>
                    <p><span class="text-black font-bold">Email :</span>  {{ $email }}</p>
                    <p><span class="text-black font-bold">No. Telp :</span>  {{ $tlp }}</p>
                    <p><span class="text-black font-bold">Jenis Kelamin :</span> {{ $jk }} </p>
                    <p><span class="text-black font-bold">Tempat, Tanggal Lahir :</span>  </p>
                    <p><span class="text-black font-bold">Alamat :</span> {{ $alamat }} </p>
                    
                    <div class="mt-3">
                        <select id="roles" name="roles" class="block w-full rounded">
                            <option value="" disabled selected>Pilih Jabatan</option>
                            <option value="" disabled>----------</option>
                            <option value="3" @if($roles == 3) selected @endif>Staff Senior</option>
                            <option value="4" @if($roles == 4) selected @endif>Staff Junior</option>
                        </select>
                    </div>

                    <div class="mt-3">
                        <select id="status" name="status" class="block w-full rounded">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="" disabled>----------</option>
                            <option value="Aktif" @if($status == 'Aktif') selected @endif>Aktif</option>
                            <option value="Tidak Aktif" @if($status == 'Tidak Aktif') selected @endif>Tidak Aktif</option>
                        </select>
                    </div>
                @else 
                    {{-- ? nama --}}
                    <div>
                        <span class="text-sm text-black font-bold">{{ __('Nama') }}</span>
                        <input wire:model="nama" :value="{{ $nama }}" id="nama" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="nama" required autofocus autocomplete="nama" />
                    </div>

                    {{-- ? username --}}
                    <div class="mt-3">
                        <span class="text-sm text-black font-bold">{{ __('Username') }}</span>
                        <input wire:model="username" id="username" :value="{{ $username }}" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="username" required autofocus autocomplete="username"/>
                    </div>

                    {{-- ? email --}}
                    <div class="mt-3">
                        <span class="text-sm text-black font-bold">{{ __('Email') }}</span>
                        <input wire:model="email" :value="{{ $email }}" id="email" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="email" required autofocus autocomplete="email" />
                    </div>

                    {{-- ? password --}}
                    <div class="mt-3">
                        <span class="text-sm text-black font-bold">{{ __('Password') }}</span>
                        <input wire:model="password" :value="{{ $password }}" id="password" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="text" name="password" required autofocus autocomplete="password" />
                    </div>

                    <div class="mt-3">
                        <span class="text-sm text-black font-bold">{{ __('Jabatan') }}</span>
                        <select id="roles" name="roles" class="block w-full rounded">
                            <option value="" disabled selected>Pilih Jabatan</option>
                            <option value="" disabled>----------</option>
                            <option value="3">Staff Senior</option>
                            <option value="4">Staff Junior</option>
                        </select>
                    </div>
                @endif

                <x-primary-button class="mt-3 block w-full justify-center">
                    {{ __('Simpan') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</div>