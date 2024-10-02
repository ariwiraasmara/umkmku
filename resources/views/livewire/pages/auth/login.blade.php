{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php
use App\Livewire\LoginPage;
// use Illuminate\Support\Facades\Session;

// use function Livewire\Volt\form;
// use function Livewire\Volt\layout;
?>
<div class="flex items-center justify-center">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
        <div class="mt-3">
            <h1 class="text-2xl font-bold text-center" x-text="$wire.title"></h1>
        </div>
        
        <div class="mt-4">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form wire:submit.prevent="login">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Username/Email')" />
                    <x-text-input wire:model="user" id="user" class="block mt-1 w-full" type="text" name="user" required autofocus autocomplete="username/email" />
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
    </div>
</div>

