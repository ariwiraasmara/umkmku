@props(['data_produk'])
<div class="static grid grid-cols-2 gap-4 mt-3">
    {{ $data_produk }}
    <div>
        <select id="id_produk" name="id_produk[]" class="block w-full rounded">
            <option value="" disabled selected>Pilih Produk</option>
            <option value="" disabled>----------</option>
            {{-- @foreach ( $data_produk as $item)
            <option value="{{ $item['id_produk'] }}">{{ $item['nama'] }}</option>
            @endforeach --}}
            <option value="prod1coba">Produk 1 Coba</option>
            <option value="prod2coba">Produk 2 Coba</option>
        </select>
    </div>

    <div>
        <input type="number" id="jumlah" name="jumlah[]" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" />
    </div>
</div>