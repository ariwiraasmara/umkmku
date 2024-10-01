{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php

?>
@extends('layouts.unauthorized')
@section('content')
    <div class="grow w-full bg-blue-400 static">
        <div class="inset-x-0 top-0 h-16 p-2">
            <h1 class="text-2xl font-bold p-2 text-white leading-tight">
                Profil
            </h1>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    
                </div>
            </div> --}}

            {{-- ?Username --}}
            <div>
                <span class="text-sm text-black font-bold">{{ __('Username') }}</span>
                <x-text-input wire:model="form.username" :value="'User 1'" id="user" class="block mt-1 w-full" type="text" name="username" required autofocus autocomplete="username" disabled />
            </div>

            {{-- ?Email --}}
            <div>
                <span class="text-sm text-black font-bold">{{ __('Email') }}</span>
                <x-text-input wire:model="form.email" :value="'user@user.com'" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="email" disabled />
            </div>

            {{-- ?Nama --}}
            <div>
                <span class="text-sm text-black font-bold">{{ __('Nama') }}</span>
                <x-text-input wire:model="form.nama" id="user" class="block mt-1 w-full" type="text" name="nama" required autofocus autocomplete="nama" />
            </div>

            {{-- ?JK --}}
            <div class="">
                <span class="text-sm text-black font-bold">Jenis Kelamin :</span>
                <span class="ml-3">
                    <input id="pria" type="radio" value="pria" name="jk" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="pria" class="ml-2 text-sm text-black dark:text-black">&nbsp;Pria</label>    
                </span>
                <span class="ml-3">
                    <input id="wanita" type="radio" value="wanita" name="jk" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="wanita" class="ml-2 text-sm text-black dark:text-black">&nbsp;Wanita</label>
                </span>
            </div>

            {{-- ?Tempat, Tanggal Lahir --}}
            <div class="flex flex-row gap-2">
                <div class="basis-1/2 flex-1">
                    <span class="text-sm text-black font-bold">{{ __('Tempat,') }}</span>
                    <x-text-input wire:model="form.tempat_lahir" id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir" required autofocus autocomplete="tempat lahir" />
                </div>
                <div class="basis-1/2 flex-1">
                    <span class="text-sm text-black font-bold">{{ __('Tanggal Lahir') }}</span>
                    <x-text-input wire:model="form.tgl_lahir" id="tgl_lahir" class="block mt-1 w-full" type="date" name="tgl_lahir" required autofocus />
                </div>
            </div>

            {{-- ?Penempatan UMKM, Jabatan, Status Aktif --}}
            <div class="flex flex-row gap-2">
                <div class="basis-1/4 flex-1">
                    <span class="text-sm text-black font-bold">{{ __('UMKM Di :') }}</span>
                    <select wire:model="form.id_umkm" id="id_umkm" name="id_umkm" class="block mt-1 w-full rounded">
                        <option value="" disabled>Pilih UMKM</option>
                        <option value="" disabled>---</option>
                        <option value="">Tidak Ada</option>
                    </select>
                </div>
                <div class="basis-1/4 flex-1">
                    <span class="text-sm text-black font-bold">{{ __('Jabatan') }}</span>
                    <x-text-input wire:model="form.jabatan" id="jabatan" class="block mt-1 w-full" type="text" name="jabatan" required autofocus autocomplete="jabatan" />
                </div>
                <div class="basis-1/4 flex-1">
                    <span class="text-sm text-black font-bold">{{ __('Status') }}</span>
                    <select wire:model="form.status" id="status" name="id_umkm" class="block mt-1 w-full rounded">
                        <option value="">Aktif</option>
                        <option value="">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            {{-- ?No. Telepon --}}
            <div>
                <span class="text-sm text-black font-bold">{{ __('No. Telepon') }}</span>
                <x-text-input wire:model="form.tlp" id="tlp" class="block mt-1 w-full" type="text" name="tlp" required autofocus autocomplete="tlp" />
            </div>

            {{-- ?Password --}}
            <div>
                <span class="text-sm text-black font-bold">{{ __('Password') }}</span>
                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="text" name="password" required autofocus autocomplete="password" />
            </div>

            {{-- ?Alamat --}}
            <div>
                <span class="text-sm text-black font-bold">{{ __('Alamat') }}</span>
                <x-text-input wire:model="form.alamat" id="alamat" class="block mt-1 w-full" type="text" name="alamat" required autofocus autocomplete="alamat" />
            </div>

            {{-- ?Foto --}}
            <div>
                <img src="" />
                <x-text-input wire:model="form.foto" id="foto" class="block mt-1 w-full" type="file" name="foto" required autofocus autocomplete="foto" />
            </div>

            <div class="mb-3"></div>
        </div>
    </div>
<x-navbottom/>
@section('content')
