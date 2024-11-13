{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<div class="flex items-center justify-center">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
        <div class="mt-3">
            <h1 class="text-2xl font-bold text-center">
                {{ $title }}
            </h1>
        </div>
        
        <div class="mt-4">
            <form action="/process/login" method="POST">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Username')" />
                    <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autofocus autocomplete="username/email" />
                    {{-- <x-input-error :messages="$errors->get('form.user')" class="mt-2" /> --}}
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    {{-- <x-input-error :messages="$errors->get('form.password')" class="mt-2" /> --}}
                </div>

                <div class="flex justify-between mt-3">
                    <!-- Remember Me -->
                    <div>
                        <label for="remember" class="">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya!') }}</span>
                        </label>
                    </div>

                    <div class="order-last">
                        <a href="/lupa-password" class=" text-sm text-gray-600 hover:underline">
                            Lupa Password?
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center justify-end mt-1">
                    <a href="/daftar-pengguna-baru">
                        <x-secondary-button class="ms-3">
                            {{ __('Register') }}
                        </x-secondary-button>
                    </a>
                    
                    <x-primary-button class="ms-3">
                        {{ __('Login') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        @if(Session::has('pesan'))
        <div id="pesan" class="mt-3 p-3 static text-center rounded-lg" onclick="closePesan()" style="background: #f00;">
            <div class="text-white " >
                <p class="text-lg font-bold">
                    {{ Session::get('pesan') }} 
                    <span class="close font-bold" style="font-size: 18px;">
                        <ion-icon name="close-circle-outline"></ion-icon>
                    </span>
                </p>
            </div>
        </div>
        @endif
    </div>

    <script>
    function closePesan() {
        document.getElementById("pesan").style.display = "none";
    }
    </script>
</div>

