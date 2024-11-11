{{--! Copyright @ Syahri Ramadhan Wiraasmara (ARI) --}}
<?php
use App\Libraries\myfunction;
use Illuminate\Support\Facades\Session;
?>
<nav class="bg-sky-800 bottom-0 fixed w-full z-1">

    @if(session('pesan'))
    <div id="navpesan" onclick="closePesan()" class="p-3 static text-center text-white" style="background: #37f">
        <p class="text-lg font-bold">{{ session('pesan') }}</p>
        <span>
            <ion-icon name="close-circle-outline" size="large"></ion-icon>
        </span>
    </div>
    @endif

    @if(session('error'))
    <div id="navpesan" onclick="closePesan()" class="p-3 static text-center text-white" style="background: #f37">
        <div class="text-white rounded-lg">
            <p class="text-lg font-bold">{{ session('error') }}</p>

            <div class="">
                <span class="close" onclick="closePesan()">
                    <ion-icon name="close-circle-outline" size="large"></ion-icon>
                </span>
            </div>
        </div>
    </div>
    @endif
    
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

    <script>
    function closePesan() {
        document.getElementById("navpesan").style.display = "none";
    }
    </script>
</nav>