<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use function Livewire\Volt\layout;
use function Livewire\Volt\rules;
use function Livewire\Volt\state;

layout('layouts.guest');

state([
    'username' => '',
    'email' => '',
    'password' => '',
    'password_confirmation' => ''
]);

rules([
    'username' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
]);

$register = function () {
    $validated = $this->validate();

    $validated['password'] = Hash::make($validated['password']);

    event(new Registered($user = User::create($validated)));

    Auth::login($user);

    $this->redirect(route('dashboard', absolute: false), navigate: true);
};

?>
@extends('layouts.unauthorized')
@section('content')
<div class="flex items-center justify-center">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg- shadow-md overflow-hidden sm:rounded-lg">
    
        <div class="mt-3">
            <h1 class="text-2xl font-bold text-center">
                Daftar Pengguna Baru
            </h1>
        </div>

        <div class="mt-4">
            <form wire:submit="register">
                <!-- Username -->
                <div>
                    <x-input-label for="name" :value="__('Username')" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="username" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
    
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
    
                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
    
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
    
                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                    <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />
    
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
    
                <div class="flex items-center justify-center mt-4">
                    <a href="/login">
                        <x-secondary-button class="ms-4">
                            <ion-icon name="arrow-back-outline" size="medium"></ion-icon>
                        </x-secondary-button>
                    </a>
    
                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection