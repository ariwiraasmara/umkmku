{{-- ! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php
use App\Libraries\myfunction;
?>
<nav class="bg-sky-800 bottom-0 fixed w-full z-1">
    <div class="inset-x-0 h-16 shadow-lg ">
        <div class="flex flex-row p-4 items-center justify-center">
            <div class="flex-1 w-50 text-center text-white">
                <a href="/dashboard" class="text-2xl font-bold p-2 leading-tight">
                    <ion-icon name="home-outline" size="large"></ion-icon>
                </a>
            </div>
    
            @if (myfunction::getCookie('mcr_x_aswq_4') < 3)
            <div class="flex-1 w-50 text-center text-white">
                <a href="/umkmku">
                    <ion-icon name="storefront-outline" size="large"></ion-icon>
                </a>
            </div>
            @endif
    
            @if (myfunction::getCookie('mcr_x_aswq_4') > 2)
            <div class="flex-1 w-50 text-center text-white">
                <a href="/transaksi">
                    <ion-icon name="cash-outline" size="large"></ion-icon>
                </a>
            </div>
            @endif
            
    
            <div class="flex-1 w-50 text-center text-white">
                <a href="/profil">
                    <ion-icon name="person-circle-outline" size="large"></ion-icon>
                </a>
            </div>
    
            <div class="flex-1 w-50 text-center text-white">
                <a href="/logout">
                    <ion-icon name="log-out-outline" size="large"></ion-icon>
                </a>
            </div>
        </div>
    </div>
</nav>