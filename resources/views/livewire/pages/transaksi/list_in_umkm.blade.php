<div class="static">
    <div class="p-2 static mb-3 flex justify-between">
        <div class="border-b border-gray-600 py-2 mb-2">
            <div class="order-first">
                <a href="{{ 'transaksi/detil/'.$id_transaksi }}">
                    <p>{{ $waktu }}</p>
                </a>
            </div>
            <div class="order-last text-white">
                <a href="{{ 'transaksi/hapus/'.$id_transaksi }}">
                    <ion-icon name="trash-outline" size="large" style="margin-top: 5px;"></ion-icon>
                </a>
            </div>
        </div>
    </div>
</div>